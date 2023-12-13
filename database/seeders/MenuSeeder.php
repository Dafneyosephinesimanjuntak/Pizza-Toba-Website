<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'nama' => 'Bandrek',                
                'price' => 15000,
                'stock' => 50,
                'description' => 'Bandrek adalah minuman khas Sunda yang banyak disukai orang. Bandrek umumnya disajikan hangat, sangat pas diminum saat malam hari atau musim hujan. Bandrek terbuat dari berbagai bahan, seperti jahe merah, gula merah, sirih, kayu manis,cengkeh, serai yang telah digeprek, dan daun pandan.',
                'image' => 'bandrek.png',
                'category' => 'Minuman'
            ],
            [
                'nama' => 'Teh manis',                
                'price' => 10000,
                'stock' => 50,
                'description' => 'Teh manis adalah minuman yang terbuat dari larutan teh yang diberi pemanis, biasanya gula tebu, sebelum minuman ini siap disajikan. Untuk konteks Indonesia, teh manis yang diberi es biasa disebut es teh.',
                'image' => 'teh.png',
                'category' => 'Minuman'
            ],
            [
              'nama' => 'Red Velvet',                
              'price' => 30000,
              'stock' => 50,
              'description' => 'Red velvet ini diciptakan dari berbagai bahan. Bahan-bahan tersebut antara lain ialah buttermilk, kakao, kopi, cuka, dan pewarna makanan merah. Red Velvet memang serupa dengan cokelat, tetapi keduanya memiliki tekstur yang berbeda.',
              'image' => 'redvelvet.png',
              'category' => 'Minuman'
          ],
          [
              'nama' => 'Teh Susu Telur',                
              'price' => 15000,
              'stock' => 50,
              'description' => 'TST adalah istilah masyarakat Medan untuk menyebut Teh Susu Telur. Minuman ini mungkin sudah tidak asing bagi orang Medan dan sudah menjadi minuman yang kerap diburu terutama pada malam hari.',
              'image' => 'tehtelor.png',
              'category' => 'Minuman'
          ],
          [
              'nama' => 'Mocktail',                
              'price' => 20000,
              'stock' => 50,
              'description' => 'Mocktail adalah jenis minuman non-alkohol yang dibuat dengan campuran jus buah dan minuman ringan lainnya.',
              'image' => 'mocktail.png',
              'category' => 'Minuman'
            ],
          [
              'nama' => 'Kopi',                
              'price' => 10000,
              'stock' => 50,
              'description' => 'Kopi adalah minuman hasil seduhan biji kopi yang telah disangrai dan dihaluskan menjadi bubuk.',
              'image' => 'kopi.png',
              'category' => 'Minuman'
          ],
          [
              'nama' => 'Aneka Jus',                
              'price' => 15000,
              'stock' => 50,
              'description' => 'Jus adalah cairan yang terdapat secara alami dalam buah-buahan. Sari buah populer dikonsumsi manusia sebagai minuman.',
              'image' => 'jus.png',
              'category' => 'Minuman'
            ],
            [
              'nama' => 'Matcha Latte',                
              'price' => 20000,
              'stock' => 50,
              'description' => 'Matcha Latte adalah minuman yang terbuat dari matcha bubuk dicampur dengan susu cair. Matcha latte maupun green tea latte tidak mengandung kopi. Kata latte berasal dari Bahasa Italia yang artinya susu.',
              'image' => 'matcha.png',
              'category' => 'Minuman'
          ],
          [
              'nama' => 'Pizza Andaliman',                
              'price' => 30000,
              'stock' => 20,
              'description' => 'Pizza andaliman menjadi menu utama dan menjadi Bestseller di PizzaToba. Pizza andaliman menggunakan toping keju dan bumbu khas Batak Toba lainnya.',
              'image' => 'pizzaandaliman.png',
              'category' => 'Makanan'
          ],
          [
            'nama' => 'Pizza Andaliman Keju',                
            'price' => 35000,
            'stock' => 20,
            'description' => 'Pizza andaliman keju menjadi menu favorit kedua kami di PizzaToba. Dengan toping keju yang lumer dan andaliman yang tak kalah pedas menjadi kesukaan para pengunjung.',
            'image' => 'pizza.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Kentang Goreng',                
            'price' => 15000,
            'stock' => 20,
            'description' => 'Kentang goreng yang sering menjadi cemilan favorit dibarengin minuman dingin dan hangat di PizzaToba.',
            'image' => 'kentang.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Pizza Daging Sapi',                
            'price' => 45000,
            'stock' => 20,
            'description' => 'Pizza daging sapi dengan daging import yang membuat PizzaToba terlihat modern dan tradisional. Pizza dengan daging sapi yang segar dan saos tomat yang melimpah.',
            'image' => 'pizzasapi.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Nugget Ayam',                
            'price' => 18000,
            'stock' => 20,
            'description' => 'Nugget ayam yang diolah langsung di PizzaToba daging ayam yang segar membuat nugget ayam sangat lezat dan kriuk.',
            'image' => 'nugget.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Burger',                
            'price' => 15000,
            'stock' => 20,
            'description' => 'Makanan berupa roti berbentuk bundar yang diiris dua dan di tengahnya diisi dengan patty yang biasanya diambil dari daging, kemudian sayur-sayuran berupa selada, tomat dan bawang.',
            'image' => 'burger.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Roti Bakar',                
            'price' => 20000,
            'stock' => 20,
            'description' => 'Sesuai dengan namanya roti bakar atau roti panggang merupakan hidangan yang memiliki dua varian yaitu manis dan gurih.',
            'image' => 'rotibakar.png',
            'category' => 'Makanan'
        ],
        [
            'nama' => 'Pizza Sosis',                
            'price' => 33000,
            'stock' => 20,
            'description' => 'Pizza sosis dengan toping sosis daging yang segar dibarengin dengan toping lainnya.',
            'image' => 'pizzasosis.png',
            'category' => 'Makanan'
        ],
        );
        foreach ($data as $d) {
            Menu::create([
                'nama' => $d['nama'],
                'price' => $d['price'],
                'stock' => $d['stock'],
                'description' => $d['description'],
                'image' => $d['image'],
                'category' => $d['category']                
            ]);
        }
    }
}
