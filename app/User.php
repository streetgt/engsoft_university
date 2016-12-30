<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model //implements AuthenticatableContract, AuthorizableContract
{
    //use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'surname', 'ssn', 'birthdate', 'gender', 'token', 'course_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Return all instructors
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllInstructors($query)
    {
        $query->whereHas('roles', function ($q) {
            $q->where('role', Role::INSTRUCTOR);
        });
    }

    /**
     * Return all students
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllStudents($query)
    {
        $query->whereHas('roles', function ($q) {
            $q->where('role', Role::STUDENT);
        });
    }

    /**
     * Return all employee's
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllEmployees($query)
    {
        $query->whereHas('roles', function ($q) {
            $q->where('role', Role::EMPLOYEE);
        });
    }

    /**
     * Check if a User have the Student Role
     *
     * @return bool
     */
    public function isStudent()
    {
        foreach ($this->roles as $role) {
            if ($role->role == Role::STUDENT)
                return true;
        }

        return false;
    }

    /**
     * Check if a User have the Student Role
     *
     * @return bool
     */
    public
    function isInstructor()
    {
        foreach ($this->roles as $role) {
            if ($role->role == Role::INSTRUCTOR)
                return true;
        }

        return false;
    }

    /**
     * Check if a User have the Employee Role
     *
     * @return bool
     */
    public function isEmployee()
    {
        foreach ($this->roles as $role) {
            if ($role->role == Role::STUDENT)
                return true;
        }

        return false;
    }

    /**
     * Relationship a User hasMany Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Relationship a User hasMany grades
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id')->orWhere('instructor_id', $this->id);
    }

    /**
     * A Student belongs to many courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course', 'student_id')->withTimestamps();
    }

    /**
     * A Student belongs to many disciplines
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'signs', 'student_id')->withTimestamps();
    }
}
