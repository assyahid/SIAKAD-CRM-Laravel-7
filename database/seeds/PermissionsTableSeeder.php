<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 25,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 26,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 27,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 28,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 29,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 30,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 31,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 32,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 33,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 34,
                'title' => 'task_create',
            ],
            [
                'id'    => 35,
                'title' => 'task_edit',
            ],
            [
                'id'    => 36,
                'title' => 'task_show',
            ],
            [
                'id'    => 37,
                'title' => 'task_delete',
            ],
            [
                'id'    => 38,
                'title' => 'task_access',
            ],
            [
                'id'    => 39,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 40,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 41,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 42,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 43,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 44,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 45,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 46,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 47,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 48,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 49,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 50,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 51,
                'title' => 'master_status_access',
            ],
            [
                'id'    => 52,
                'title' => 'status_create',
            ],
            [
                'id'    => 53,
                'title' => 'status_edit',
            ],
            [
                'id'    => 54,
                'title' => 'status_show',
            ],
            [
                'id'    => 55,
                'title' => 'status_delete',
            ],
            [
                'id'    => 56,
                'title' => 'status_access',
            ],
            [
                'id'    => 57,
                'title' => 'master_kela_access',
            ],
            [
                'id'    => 58,
                'title' => 'mkela_create',
            ],
            [
                'id'    => 59,
                'title' => 'mkela_edit',
            ],
            [
                'id'    => 60,
                'title' => 'mkela_show',
            ],
            [
                'id'    => 61,
                'title' => 'mkela_delete',
            ],
            [
                'id'    => 62,
                'title' => 'mkela_access',
            ],
            [
                'id'    => 63,
                'title' => 'tahun_ajaran_access',
            ],
            [
                'id'    => 64,
                'title' => 'm_tahun_ajaran_create',
            ],
            [
                'id'    => 65,
                'title' => 'm_tahun_ajaran_edit',
            ],
            [
                'id'    => 66,
                'title' => 'm_tahun_ajaran_show',
            ],
            [
                'id'    => 67,
                'title' => 'm_tahun_ajaran_delete',
            ],
            [
                'id'    => 68,
                'title' => 'm_tahun_ajaran_access',
            ],
            [
                'id'    => 69,
                'title' => 'master_siswa_access',
            ],
            [
                'id'    => 70,
                'title' => 'm_master_siswa_create',
            ],
            [
                'id'    => 71,
                'title' => 'm_master_siswa_edit',
            ],
            [
                'id'    => 72,
                'title' => 'm_master_siswa_show',
            ],
            [
                'id'    => 73,
                'title' => 'm_master_siswa_delete',
            ],
            [
                'id'    => 74,
                'title' => 'm_master_siswa_access',
            ],
            [
                'id'    => 75,
                'title' => 'master_jurusan_access',
            ],
            [
                'id'    => 76,
                'title' => 'm_jurusan_create',
            ],
            [
                'id'    => 77,
                'title' => 'm_jurusan_edit',
            ],
            [
                'id'    => 78,
                'title' => 'm_jurusan_show',
            ],
            [
                'id'    => 79,
                'title' => 'm_jurusan_delete',
            ],
            [
                'id'    => 80,
                'title' => 'm_jurusan_access',
            ],
            [
                'id'    => 81,
                'title' => 'master_kelamin_access',
            ],
            [
                'id'    => 82,
                'title' => 'mkelamin_create',
            ],
            [
                'id'    => 83,
                'title' => 'mkelamin_edit',
            ],
            [
                'id'    => 84,
                'title' => 'mkelamin_show',
            ],
            [
                'id'    => 85,
                'title' => 'mkelamin_delete',
            ],
            [
                'id'    => 86,
                'title' => 'mkelamin_access',
            ],
            [
                'id'    => 87,
                'title' => 'master_guru_access',
            ],
            [
                'id'    => 88,
                'title' => 'm_guru_create',
            ],
            [
                'id'    => 89,
                'title' => 'm_guru_edit',
            ],
            [
                'id'    => 90,
                'title' => 'm_guru_show',
            ],
            [
                'id'    => 91,
                'title' => 'm_guru_delete',
            ],
            [
                'id'    => 92,
                'title' => 'm_guru_access',
            ],
            [
                'id'    => 93,
                'title' => 'course_create',
            ],
            [
                'id'    => 94,
                'title' => 'course_edit',
            ],
            [
                'id'    => 95,
                'title' => 'course_show',
            ],
            [
                'id'    => 96,
                'title' => 'course_delete',
            ],
            [
                'id'    => 97,
                'title' => 'course_access',
            ],
            [
                'id'    => 98,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 99,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 100,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 101,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 102,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 103,
                'title' => 'test_create',
            ],
            [
                'id'    => 104,
                'title' => 'test_edit',
            ],
            [
                'id'    => 105,
                'title' => 'test_show',
            ],
            [
                'id'    => 106,
                'title' => 'test_delete',
            ],
            [
                'id'    => 107,
                'title' => 'test_access',
            ],
            [
                'id'    => 108,
                'title' => 'question_create',
            ],
            [
                'id'    => 109,
                'title' => 'question_edit',
            ],
            [
                'id'    => 110,
                'title' => 'question_show',
            ],
            [
                'id'    => 111,
                'title' => 'question_delete',
            ],
            [
                'id'    => 112,
                'title' => 'question_access',
            ],
            [
                'id'    => 113,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 114,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 115,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 116,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 117,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 118,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 119,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 120,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 121,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 122,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 123,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 124,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 125,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 126,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 127,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 128,
                'title' => 'jadwal_access',
            ],
            [
                'id'    => 129,
                'title' => 'list_jadwal_pelajaran_create',
            ],
            [
                'id'    => 130,
                'title' => 'list_jadwal_pelajaran_edit',
            ],
            [
                'id'    => 131,
                'title' => 'list_jadwal_pelajaran_show',
            ],
            [
                'id'    => 132,
                'title' => 'list_jadwal_pelajaran_delete',
            ],
            [
                'id'    => 133,
                'title' => 'list_jadwal_pelajaran_access',
            ],
            [
                'id'    => 134,
                'title' => 'master_pelajaran_access',
            ],
            [
                'id'    => 135,
                'title' => 'list_master_pelajaran_create',
            ],
            [
                'id'    => 136,
                'title' => 'list_master_pelajaran_edit',
            ],
            [
                'id'    => 137,
                'title' => 'list_master_pelajaran_show',
            ],
            [
                'id'    => 138,
                'title' => 'list_master_pelajaran_delete',
            ],
            [
                'id'    => 139,
                'title' => 'list_master_pelajaran_access',
            ],
            [
                'id'    => 140,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
