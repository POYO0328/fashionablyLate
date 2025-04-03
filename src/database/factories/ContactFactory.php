<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Contact;
class ContactFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Contact::class;


  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
    'first_name' => $this->faker->firstname,
    'last_name' => $this->faker->lastname,
    'gender' => $this->faker->numberBetween(1,3),
    'email' => $this->faker->safeEmail(),
    'tell'=> $this->faker->numberBetween(1111111111,9999999999),
    'address'=> $this->faker->randomElement([
    '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
    '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
    '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
    '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
    '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
    '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
    '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
]),
    'building'=> $this->faker->randomElement([
    'サンシャインビル', 'グランドタワー', 'ヒルズレジデンス', 'パークマンション',
    'スカイハイツ', 'シティタワー', 'ロイヤルコート', 'ガーデンプレイス',
    'セントラルビル', 'メゾン・ド・シャンブル', 'タウンハウス', 'アーバンレジデンス',
    'グリーンハウス', 'レジデンスA', 'シルバーハイツ', 'ゴールデンパレス'
]),
    'category_id'=> $this->faker->numberBetween(1,5),
    'detail' => $this->faker->sentence(),
    ];
  }
}