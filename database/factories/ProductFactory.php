<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
		srand(hrtime(true));
        
		$langs = DB::table('langs')->get();
        
        $short_descriptionKeysCount = DB::table('lang_keys')->where('topic', 'PRODUCTS_SHORT_DESCRIPTION')->count();
        $short_descriptionKeyId = DB::table('lang_keys')->insertGetId(['name' => "products_short_description_$short_descriptionKeysCount", 'topic' => 'PRODUCTS_SHORT_DESCRIPTION', 'created_at' => now(), 'updated_at' => now()]) ;

        $inserts = [];
        
        foreach($langs as $lang) {
            $code = $lang->code;
            $faker = fake($code);
            $provider = "Faker\Provider\\$code\Text";
            $faker->addProvider(new $provider($faker));
            $value = '';
            if (class_exists($provider) && $code != 'en_US') {
                gc_collect_cycles();
                $faker->addProvider(new $provider($faker));
                $value = $faker->realText(255);
            } else {
                $value = $faker->text();
            }
            $inserts[] = ['lang_id' => $lang->id, 'lang_key_id' => $short_descriptionKeyId, 'value' => $value, 'created_at' => now(), 'updated_at' => now()];
        }
        
        DB::table('lang_values')->insert($inserts);
        
        $seo_titleKeysCount = DB::table('lang_keys')->where('topic', 'PRODUCTS_SEO_TITLE')->count();
        $seo_titleKeyId = DB::table('lang_keys')->insertGetId(['name' => "products_seo_title_$seo_titleKeysCount", 'topic' => 'PRODUCTS_SEO_TITLE', 'created_at' => now(), 'updated_at' => now()]) ;

        $inserts = [];
        
        foreach($langs as $lang) {
            $code = $lang->code;
            $faker = fake($code);
            $provider = "Faker\Provider\\$code\Text";
            $faker->addProvider(new $provider($faker));
            $value = '';
            if (class_exists($provider) && $code != 'en_US') {
                gc_collect_cycles();
                $faker->addProvider(new $provider($faker));
                $value = $faker->realText(255);
            } else {
                $value = $faker->text();
            }
            $inserts[] = ['lang_id' => $lang->id, 'lang_key_id' => $seo_titleKeyId, 'value' => $value, 'created_at' => now(), 'updated_at' => now()];
        }
        
        DB::table('lang_values')->insert($inserts);


        $faker = fake();

        return [
			'category_id' => Category::inRandomOrder()->first()->id,
			'name' => $faker->text(255),
			'slug' => $faker->text(255),
			'short_description_key_id' => $short_descriptionKeyId,
			'long_description' => $faker->sentence(),
			'sku' => $faker->text(100),
			'price' => $faker->randomNumber(),
			'sale_price' => $faker->randomNumber(),
			'inventory_quantity' => $faker->randomNumber(),
			'featured_image' => "https://d2ou4q7eh16cxk.cloudfront.net/computer/" .rand(0, 99) .".jpg",
			'seo_title_key_id' => $seo_titleKeyId,
			'seo_description' => $faker->sentence(),
			'weight' => $faker->randomNumber(),
			'dimensions' => $faker->text(100),
			'shipping_class' => $faker->text(50),
			'featured_flag' => $faker->numberBetween(0, 1),
			'status' => $faker->randomElement(["draft","active","inactive","archived"]),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
