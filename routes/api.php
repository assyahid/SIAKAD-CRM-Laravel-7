<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Contact Company
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Mkelas
    Route::apiResource('mkelas', 'MkelasApiController');

    // M Tahun Ajaran
    Route::apiResource('m-tahun-ajarans', 'MTahunAjaranApiController');

    // M Master Siswa
    Route::post('m-master-siswas/media', 'MMasterSiswaApiController@storeMedia')->name('m-master-siswas.storeMedia');
    Route::apiResource('m-master-siswas', 'MMasterSiswaApiController');

    // M Jurusan
    Route::apiResource('m-jurusans', 'MJurusanApiController');

    // Mkelamin
    Route::apiResource('mkelamins', 'MkelaminApiController');

    // M Guru
    Route::post('m-gurus/media', 'MGuruApiController@storeMedia')->name('m-gurus.storeMedia');
    Route::apiResource('m-gurus', 'MGuruApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Lessons
    Route::post('lessons/media', 'LessonsApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonsApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Question Options
    Route::apiResource('question-options', 'QuestionOptionsApiController');

    // Test Results
    Route::apiResource('test-results', 'TestResultsApiController');

    // Test Answers
    Route::apiResource('test-answers', 'TestAnswersApiController');

    // List Jadwal Pelajaran
    Route::apiResource('list-jadwal-pelajarans', 'ListJadwalPelajaranApiController');

    // List Master Pelajaran
    Route::apiResource('list-master-pelajarans', 'ListMasterPelajaranApiController');
});
