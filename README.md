# LaraMin - Zero Config Admin Boilerplate with Laravel and Sanctum

LaraMin is a zero-config Admin boilerplate with Laravel Sanctum and comes with excellent user, office , role management and  `ACL` features out of the box. Start your next big project with vuemin, focus on building business logic, and save countless hours of implementing boring user and role management again and again

## Requirements

- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

Just clone the project to anywhere in your computer.
Run ` composer install ` <br>
and ` php artisan migrate --seed`

Now you are done.
<br>

` php artisan serve ` and open the project on the browser.


## ACL Pattern

We will follow module name singular and table name laravel default (plural) maintain snake case as laravel maintain for table name:

`module_name.table_name.ability`

For example: 
- `ipcp.case_types.index`
- `office_management.offices.index  `

We need to follow laravel default route naming pattern if you don't want to follow laravel default then follow our `ACL` Pattern strictly

Here is some example for routes and acl 

```
Route::middleware(['auth:sanctum','acl:ipcp'])->group(function () {
    Route::apiResource('/case-types',   CaseTypeController::class);

});
```
**Here we have pass module name as param like `acl:module_name`**

Laravel will automatically generate routes like this 
- `case-types.index `
- `case-types.show `
- `case-types.store `
- `case-types.destroy `

Our ACL Middleware will handle route name snake case automatically like `case_types.index`


**Here is the snippet of middleware `CheckPermission`**

```
public function handle(Request $request, Closure $next, $module = null)
    {

        $user = $request->user();
        $routeName = request()->route()->getName();
        $askingFeature = $module.'.'.$routeName;
        $askingFeature = str_replace("-","_", $askingFeature);
        $ignoreRoute = config('acl.ignore');
        if ($module && in_array($askingFeature,$user->acl->merge($ignoreRoute)->toArray())){
            return $next($request);
        }
        return $this->error("You don't have permission !");
    }
```
