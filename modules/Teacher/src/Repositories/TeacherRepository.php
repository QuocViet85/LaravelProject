<?php
namespace Modules\Teacher\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Teacher\src\Models\Teacher;

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function getModel()
    {
        return Teacher::class;
    }

    public function getAllTeachers()
    {
        return $this->model->select(['id', 'name', 'slug', 'description', 'exp', 'image', 'created_at']);
    }    
}