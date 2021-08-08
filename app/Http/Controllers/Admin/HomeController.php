<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Last Siswa',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\MMasterSiswa',
            'group_by_field'        => 'tgl_lahir',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'nama'      => '',
                'tgl_lahir' => '',
                'nisn'      => '',
                'jurusan'   => 'nama',
                'kelas'     => 'nama',
                'kelamin'   => 'nama',
            ],
            'translation_key' => 'mMasterSiswa',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'Last Guru',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\MGuru',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'nama'          => '',
                'kelamin'       => 'nama',
                'tgl_lahir'     => '',
                'mulai_bekerja' => '',
            ],
            'translation_key' => 'mGuru',
        ];

        $settings2['data'] = [];
        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        $settings3 = [
            'chart_title'        => 'Jenis Kelamin Siswa',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\MMasterSiswa',
            'group_by_field'     => 'nama',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'kelamin',
            'translation_key'    => 'mMasterSiswa',
        ];

        $chart3 = new LaravelChart($settings3);

        return view('home', compact('settings1', 'settings2', 'chart3'));
    }
}
