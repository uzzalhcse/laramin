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
