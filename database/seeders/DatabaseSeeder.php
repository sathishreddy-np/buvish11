<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Availability;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Limit;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Restriction;
use App\Models\Role;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Timing;
use App\Models\User;
use App\Models\Variant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nnjeim\World\Actions\SeedAction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SeedAction::class,
        ]);
        // User::factory(10)->create();
        $company = Company::factory()
            ->has(
                Team::factory(2)
                    ->has(
                        Customer::factory(5)
                            ->has(
                                Invoice::factory()
                                    ->has(Payment::factory())
                            )
                    )
                    ->has(Category::factory(5))
                    ->has(Brand::factory(5))
                    ->has(Product::factory(5)->has(Variant::factory(5))->has(InvoiceItem::factory()))
                    ->has(Attribute::factory(5)->has(AttributeValue::factory(5)))
                    ->has(Coupon::factory(5))
                    ->has(Tag::factory(5))
                    ->has(Promotion::factory(5))
                    ->has(Activity::factory(2)->has(Availability::factory(7))->has(Timing::factory(70))->has(Restriction::factory(3)))
            )
            ->has(Limit::factory())
            ->createQuietly();

        $teams = Team::all();

        $user = User::factory()->createQuietly([
            'company_id' => $company->id,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '12345678',
        ]);

        $user->teams()->attach($teams);

        $all_models = array_slice(array_map(fn ($value) => str_replace('.php', '', $value), scandir(app_path('Models'))), 2);
        $exclude_models = [
            'City',
            'State',
            'Country',
            'Timezone',
            'Currency',
            'Language',
            'Limit', // Super Admin only have access
        ];
        $models = array_diff($all_models, $exclude_models);

        // $models = Limit::where('company_id', $company->id)->get()->pluck('model');

        $permissions = ['viewAny', 'view', 'create', 'update', 'delete', 'deleteAny', 'restore', 'restoreAny', 'forceDelete', 'forceDeleteAny'];
        foreach ($models as $model) {
            foreach ($permissions as $permission) {
                $model = ucwords($model);
                $record = [
                    'name' => "$model::$permission",
                    'guard_name' => 'web',
                ];
                Permission::create($record);
            }
        }

        $roles = ['Super Admin','Admin', 'Manager', 'Trainer', 'Receptionist', 'Accountant'];
        foreach ($roles as $role) {
            $record = [
                'company_id' => $company->id,
                'name' => "$role",
                'guard_name' => 'web',
            ];
            Role::create($record);
        }

        $products = Product::inRandomOrder()->take(5)->get();
        $categories = Category::all();

        foreach ($categories as $category) {
            $category->products()->attach($products);
        }

        $roles = Role::all();
        $user->roles()->attach($roles);

        $role = Role::where('name', 'Admin')->first();
        $permissions = Permission::all();

        if ($role) {
            $role->permissions()->attach($permissions);
            $company->permissions()->attach($permissions);
        }
    }
}
