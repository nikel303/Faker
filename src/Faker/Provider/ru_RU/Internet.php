<?php

namespace Faker\Provider\ru_RU;

class Internet extends \Faker\Provider\Internet {

	protected static $safeEmailTld = array('ru', 'com', 'net', 'su', 'org');
	protected static $freeEmailDomain = array('gmail.com', 'ya.ru', 'yandex.ru', 'rambler.ru', 'mail.ru', 'list.ru', 'bk.ru');
	protected static $tld = array('com', 'net', 'org', 'ru', 'su', 'ru', 'ru', 'ru', 'ru');

	protected static $userNameFormats = array(
		'{{lastName}}.{{firstName}}',
		'{{lastName}}_{{firstName}}',
		'{{lastName}}_{{firstName}}##',
		'{{firstName}}.{{lastName}}',
		'{{firstName}}_{{lastName}}',
		'{{firstName}}_{{lastName}}##',
		'{{firstName}}##',
		'?{{firstName}}##',
		'?{{lastName}}',
		'?{{lastName}}##',
	);
	protected static $emailFormats = array(
		'{{userName}}@{{domainName}}',
		'{{userName}}@{{freeEmailDomain}}',
		'{{userName}}@{{freeEmailDomain}}',
		'{{userName}}@{{freeEmailDomain}}',
	);

	public function userName() {
		$format = static::randomElement(static::$userNameFormats);
		return $this->getTranslit(mb_strtolower(static::bothify($this->generator->parse($format))));
	}

	public function domainWord() {
		$company = $this->generator->format('company');
		$companyElements = explode(' ', $company);
		$company = $companyElements[0];
		$company = preg_replace('/\W/ui', '', $company);

		return $this->getTranslit(mb_strtolower($company));
	}

	protected function getTranslit($str) {

		$pattern = array(
			'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ъ', 'ы', 'э',
			'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ъ', 'Ы', 'Э',
			'ж', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я',
			'Ж', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ю', 'Я',
		);

		$replacement = array(
			'a', 'b', 'v', 'g', 'd', 'e', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', '', 'i', 'e',
			'A', 'B', 'V', 'G', 'D', 'E', 'E', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', '', 'I', 'E',
			'zh', 'ts', 'ch', 'sh', 'shch', '', 'yu', 'ya',
			'Zh', 'Ts', 'Ch', 'Sh', 'Shch', '', 'Yu', 'Ya',
		);

		for ($i = 0; $i < sizeof($pattern); $i++) {
			$str = mb_ereg_replace($pattern[$i], $replacement[$i], $str);
		}

		return $str;
	}

}
