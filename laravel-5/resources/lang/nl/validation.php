<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute moet geaccepteerd zijn.",
	"active_url"           => ":attribute is geen geldige URL.",
	"after"                => ":attribute moet een datum zijn na :date.",
	"alpha"                => ":attribute mag alleen letters bevatten.",
	"alpha_dash"           => ":attribute mag alleen letters, cijfers, onderstreep(_) en strepen (-) bevatten.",
	"alpha_num"            => ":attribute mag allee letters en cijfers bevatten.",
	"array"                => ":attribute moet een verzameling zijn.",
	"before"               => ":attribute moet een datum zijn voor :date.",
	"between"              => [
		"numeric" => ":attribute moet tussen :min en :max zijn.",
		"file"    => ":attribute moet tussen :min en :max kilobytes zijn.",
		"string"  => ":attribute moet tussen :min en :max karakters zijn.",
		"array"   => ":attribute moet tussen :min en :max items bevatten.",
	],
	"boolean"              => ":attribute moet juist of fout zijn.",
	"confirmed"            => ":attribute bevestiging komt niet overeen.",
	"date"                 => ":attribute is geen geldige datum.",
	"date_format"          => ":attribute moet van het formaat :format zijn.",
	"different"            => ":attribute en :other moeten verschillend zijn.",
	"digits"               => ":attribute moet bestaan uit :digits cijfers.",
	"digits_between"       => ":attribute moet bestaan uit minimaal :min en maximaal :max cijfers.",
	"email"                => ":attribute is geen geldig emailadres.",
	"filled"               => ":attribute is verplicht.",
	"exists"               => ":attribute bestaat niet.",
	"image"                => ":attribute moet een afbeelding zijn.",
	"in"                   => ":attribute is ongeldig.",
	"integer"              => ":attribute moet een getal zijn.",
	"ip"                   => ":attribute moet een geldig IP-adres zijn.",
	"max"                  => [
		"numeric" => ":attribute moet kleiner zijn dan :max.",
		"file"    => ":attribute moet kleiner zijn dan :max kilobytes.",
		"string"  => ":attribute moet korter zijn dan :max karakters.",
		"array"   => ":attribute mag maximaal :max items bevatten.",
	],
	"mimes"                => ":attribute moet een bestand zijn van het type: :values.",
	"min"                  => [
		"numeric" => ":attribute moet minimaal :min zijn.",
		"file"    => ":attribute moet minimaal :min kilobytes zijn.",
		"string"  => ":attribute moet minimaal :min karakters zijn.",
		"array"   => ":attribute moet minimaal :min items bevatten.",
	],
	"not_in"               => "Het formaat van :attribute is ongeldig.",
	"numeric"              => ":attribute moet een nummer zijn.",
	"regex"                => ":attribute formaat is ongeldig.",
	"required"             => ":attribute is verplicht.",
	"required_if"          => ":attribute is verplicht indien :other gelijk is aan :value.",
	"required_with"        => ":attribute is verplicht in combinatie met :values.",
	"required_with_all"    => ":attribute is verplicht in combinatie met :values.",
	"required_without"     => ":attribute is verplicht indien :values niet is ingevuld.",
	"required_without_all" => ":attribute is verplicht indien :values niet zijn ingevuld.",
	"same"                 => ":attribute en :other moeten overeenkomen.",
	"size"                 => [
		"numeric" => ":attribute moet :size zijn.",
		"file"    => ":attribute moet :size kilobytes zijn.",
		"string"  => ":attribute moet :size karakters zijn.",
		"array"   => ":attribute moet :size items bevatten.",
	],
	"unique"               => ":attribute is al in gebruik.",
	"url"                  => ":attribute is geen geldige URL.",
	"timezone"             => ":attribute moet een geldige zone zijn.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
        "name" => "Naam",
        "firstName" => "Voornaam",
        "emailAddress" => "Email",
        "dateOfBirth" => "Geboortedatum",
        "isMale" => "Geslacht",
        "nameOfTheRace" => "Name",
        "distance" => "Afstand",
        "city" => "Stad"
    ],

];
