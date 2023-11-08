<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Municipality;
use App\Models\Neighborhood;
use App\Models\Permission;
use App\Models\Property;
use App\Models\PropertyStatus;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Region;
use App\Models\Role;
use App\Models\Subcategory;
use App\Models\User;
use App\Policies\AmenityPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\MunicipalityPolicy;
use App\Policies\NeighborhoodPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PropertyPolicy;
use App\Policies\PropertyStatusPolicy;
use App\Policies\PropertyTypePolicy;
use App\Policies\ProvincePolicy;
use App\Policies\RegionPolicy;
use App\Policies\RolePolicy;
use App\Policies\SubcategoryPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Property::class => PropertyPolicy::class,
        PropertyStatus::class => PropertyStatusPolicy::class,
        PropertyType::class => PropertyTypePolicy::class,
        Amenity::class => AmenityPolicy::class,
        Category::class => CategoryPolicy::class,
        Subcategory::class => SubcategoryPolicy::class,
        Neighborhood::class => NeighborhoodPolicy::class,
        Municipality::class => MunicipalityPolicy::class,
        Province::class => ProvincePolicy::class,
        Region::class => RegionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
