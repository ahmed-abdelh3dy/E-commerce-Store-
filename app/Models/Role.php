<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'names'
    ];

    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }


    public static function createWithRoleAbility(Request $request)
    {

        DB::beginTransaction();
        try {
            $role = Role::create([
                'names' => $request->post('name')

            ]);


            foreach ($request->post('abilities') as $ability => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type' => $value
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $role;
    }


    public  function updateWithRoleAbility(Request $request)
    {

        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->post('name')
            ]);

            foreach ($request->post('abilities') as $ability => $value) {
                RoleAbility::updateOrCreate(
                    [
                        'role_id' => $this->id,
                        'ability' => $ability,
                    ],
                    [

                        'type' => $value
                    ]
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $this;
    }
}
