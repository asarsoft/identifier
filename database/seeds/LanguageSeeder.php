<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('languages')->insert([
			'guid' => uniqid(),
			'name' => 'English',
			'language_code' => 'en',
			'is_featured' => true
		]);

		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Afar', 'language_code' => 'aa']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Abkhazian', 'language_code' => 'ab']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Afrikaans', 'language_code' => 'af']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Amharic', 'language_code' => 'am']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Arabic', 'language_code' => 'ar']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Assamese', 'language_code' => 'as']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Aymara', 'language_code' => 'ay']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Azerbaijani', 'language_code' => 'az']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bashkir', 'language_code' => 'ba']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Belarusian', 'language_code' => 'be']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bulgarian', 'language_code' => 'bg']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bihari', 'language_code' => 'bh']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bislama', 'language_code' => 'bi']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bengali/Bangla', 'language_code' => 'bn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tibetan', 'language_code' => 'bo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Breton', 'language_code' => 'br']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Catalan', 'language_code' => 'ca']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Corsican', 'language_code' => 'co']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Czech', 'language_code' => 'cs']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Welsh', 'language_code' => 'cy']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Danish', 'language_code' => 'da']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'German', 'language_code' => 'de']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Bhutani', 'language_code' => 'dz']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Greek', 'language_code' => 'el']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Esperanto', 'language_code' => 'eo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Spanish', 'language_code' => 'es']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Estonian', 'language_code' => 'et']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Basque', 'language_code' => 'eu']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Persian', 'language_code' => 'fa']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Finnish', 'language_code' => 'fi']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Fiji', 'language_code' => 'fj']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Faeroese', 'language_code' => 'fo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'French', 'language_code' => 'fr']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Frisian', 'language_code' => 'fy']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Irish', 'language_code' => 'ga']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Scots/Gaelic', 'language_code' => 'gd']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Galician', 'language_code' => 'gl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Guarani', 'language_code' => 'gn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Gujarati', 'language_code' => 'gu']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Hausa', 'language_code' => 'ha']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Hindi', 'language_code' => 'hi']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Croatian', 'language_code' => 'hr']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Hungarian', 'language_code' => 'hu']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Armenian', 'language_code' => 'hy']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Interlingua', 'language_code' => 'ia']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Interlingue', 'language_code' => 'ie']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Inupiak', 'language_code' => 'ik']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Indonesian', 'language_code' => 'in']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Icelandic', 'language_code' => 'is']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Italian', 'language_code' => 'it']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Hebrew', 'language_code' => 'iw']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Japanese', 'language_code' => 'ja']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Yiddish', 'language_code' => 'ji']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Javanese', 'language_code' => 'jw']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Georgian', 'language_code' => 'ka']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kazakh', 'language_code' => 'kk']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Greenlandic', 'language_code' => 'kl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Cambodian', 'language_code' => 'km']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kannada', 'language_code' => 'kn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Korean', 'language_code' => 'ko']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kashmiri', 'language_code' => 'ks']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kurdish', 'language_code' => 'ku']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kirghiz', 'language_code' => 'ky']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Latin', 'language_code' => 'la']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Lingala', 'language_code' => 'ln']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Laothian', 'language_code' => 'lo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Lithuanian', 'language_code' => 'lt']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Latvian/Lettish', 'language_code' => 'lv']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Malagasy', 'language_code' => 'mg']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Maori', 'language_code' => 'mi']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Macedonian', 'language_code' => 'mk']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Malayalam', 'language_code' => 'ml']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Mongolian', 'language_code' => 'mn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Moldavian', 'language_code' => 'mo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Marathi', 'language_code' => 'mr']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Malay', 'language_code' => 'ms']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Maltese', 'language_code' => 'mt']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Burmese', 'language_code' => 'my']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Nauru', 'language_code' => 'na']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Nepali', 'language_code' => 'ne']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Dutch', 'language_code' => 'nl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Norwegian', 'language_code' => 'no']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Occitan', 'language_code' => 'oc']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => '(Afan)/Oromoor/Oriya', 'language_code' => 'om']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Punjabi', 'language_code' => 'pa']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Polish', 'language_code' => 'pl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Pashto/Pushto', 'language_code' => 'ps']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Portuguese', 'language_code' => 'pt']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Quechua', 'language_code' => 'qu']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Rhaeto-Romance', 'language_code' => 'rm']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kirundi', 'language_code' => 'rn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Romanian', 'language_code' => 'ro']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Russian', 'language_code' => 'ru']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Kinyarwanda', 'language_code' => 'rw']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Sanskrit', 'language_code' => 'sa']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Sindhi', 'language_code' => 'sd']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Sangro', 'language_code' => 'sg']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Serbo-Croatian', 'language_code' => 'sh']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Singhalese', 'language_code' => 'si']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Slovak', 'language_code' => 'sk']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Slovenian', 'language_code' => 'sl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Samoan', 'language_code' => 'sm']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Shona', 'language_code' => 'sn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Somali', 'language_code' => 'so']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Albanian', 'language_code' => 'sq']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Serbian', 'language_code' => 'sr']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Siswati', 'language_code' => 'ss']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Sesotho', 'language_code' => 'st']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Sundanese', 'language_code' => 'su']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Swedish', 'language_code' => 'sv']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Swahili', 'language_code' => 'sw']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tamil', 'language_code' => 'ta']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Telugu', 'language_code' => 'te']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tajik', 'language_code' => 'tg']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Thai', 'language_code' => 'th']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tigrinya', 'language_code' => 'ti']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Turkmen', 'language_code' => 'tk']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tagalog', 'language_code' => 'tl']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Setswana', 'language_code' => 'tn']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tonga', 'language_code' => 'to']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Turkish', 'language_code' => 'tr']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tsonga', 'language_code' => 'ts']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Tatar', 'language_code' => 'tt']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Twi', 'language_code' => 'tw']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Ukrainian', 'language_code' => 'uk']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Urdu', 'language_code' => 'ur']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Uzbek', 'language_code' => 'uz']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Vietnamese', 'language_code' => 'vi']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Volapuk', 'language_code' => 'vo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Wolof', 'language_code' => 'wo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Xhosa', 'language_code' => 'xh']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Yoruba', 'language_code' => 'yo']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Chinese', 'language_code' => 'zh']);
		DB::table('languages')->insert(['guid' => uniqid(), 'name' => 'Zulu', 'language_code' => 'zu']);
	}
}
