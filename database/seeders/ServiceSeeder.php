<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Service::truncate();
        Schema::enableForeignKeyConstraints();

        $services = [
            [
                'name' => 'Web Development',
                'description' => 'Complete web development solutions including frontend and backend development.',
                'price' => 999.99,
                'status' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Native and cross-platform mobile application development.',
                'price' => 1499.99,
                'status' => true,
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Professional user interface and user experience design services.',
                'price' => 599.99,
                'status' => true,
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Comprehensive digital marketing strategies and implementation.',
                'price' => 799.99,
                'status' => true,
            ],
            [
                'name' => 'SEO Optimization',
                'description' => 'Search engine optimization to improve your website visibility.',
                'price' => 399.99,
                'status' => false, // Inactive service
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
