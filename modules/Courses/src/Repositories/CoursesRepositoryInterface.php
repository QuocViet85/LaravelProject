<?php
namespace Modules\Courses\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CoursesRepositoryInterface extends RepositoryInterface
{
    public function getAllCourses();

    public function createCourseCategories($course, $data = []);

    public function getRelatedCategories($course);

    public function updateCourseCategories($course, $data = []);

    public function deleteCourseCategories($course);
}