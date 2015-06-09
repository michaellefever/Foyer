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

	"accepted"             => "Le champ :attribute doit être accepté.",
	"active_url"           => "Le champ :attribute n'est pas une URL valide.",
	"after"                => "Le champ :attribute doit être une date postérieure au :date.",
	"alpha"                => "Le champ :attribute doit seulement contenir des lettres.",
	"alpha_dash"           => "Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets.",
	"alpha_num"            => "Le champ :attribute doit seulement conteni only contain letters and numbers.",
	"array"                => "Le champ :attribute doit être un tableau.",
	"before"               => "Le champ :attribute doit être une date antérieure au :date.",
	"between"              => [
		"numeric" => "La valeur de :attribute doit être comprise entre :min et :max.",
		"file"    => "Le fichier :attribute doit avoir une taille entre :min et :max kilo-octets.",
		"string"  => "Le texte :attribute doit avoir entre :min et :max caractères.",
		"array"   => "Le tableau :attribute doit avoir entre :min et :max éléments.",
	],
	"boolean"              => "Le champ :attribute doit être vrai ou faux.",
	"confirmed"            => "Le champ de confirmation :attribute ne correspond pas.",
	"date"                 => "Le champ :attribute n'est pas une date valide.",
	"date_format"          => "Le champ :attribute ne correspond pas au format :format.",
	"different"            => "Les champs :attribute et :other doivent être différents.",
	"digits"               => "Le champs :attribute doit avoir :digits chiffres.",
	"digits_between"       => "Le champs :attribute doit avoir entre :min et :max digits.",
	"email"                => "Le champ :attribute doit être une adresse eamil valide.",
	"filled"               => "Le champ :attribute est obligatoire.",
	"exists"               => "Le champ :attribute sélectionné est invalide.",
	"image"                => "Le champ :attribute doit être une image.",
	"in"                   => "Le champ :attribute est invalide.",
	"integer"              => "Le champ :attribute doit être un nombre entier.",
	"ip"                   => "Le champ :attribute doit être une adresse IP valide.",
	"max"                  => [
		"numeric" => "La valeur de :attribute ne peut pas être supérieure à :max.",
		"file"    => "Le fichier :attribute ne peut pas être plus gros que :max kilo-octets.",
		"string"  => "Le texte de :attribute ne peut pas contenir plus de :max caractères.",
		"array"   => "Le tableau :attribute ne peut pas avoir plus de :max éléments.",
	],
	"mimes"                => "Le champ :attribute doit être un fichier de type: :values.",
	"min"                  => [
		"numeric" => "La valeur de :attribute doit être supérieure à :min.",
		"file"    => "Le fichier :attribute doit être plus gros que :min kilo-octets.",
		"string"  => "Le texte de :attribute doit contenir au moins :min caractères.",
		"array"   => "Le tableau :attribute doit avoir au moins :min éléments.",
	],
	"not_in"               => "Le champ :attribute sélectionné n'est pas valide.",
	"numeric"              => "Le champ :attribute doit être un nombre.",
	"regex"                => "Le format du champ :attribute est invalide.",
	"required"             => "Le champ :attribute est obligatoire.",
	"required_if"          => "Le champ :attribute est obligatoire quand valeur de :other est :value.",
	"required_with"        => "Le champ :attribute est obligatoire quand :values est présent.",
	"required_with_all"    => "Le champ :attribute est obligatoire quand :values est présent.",
	"required_without"     => "Le champ :attribute est obligatoire quand :values n'est pas présent.",
	"required_without_all" => "Le champ :attribute est obligatoire quand aucun de :values sont présent.",
	"same"                 => "Les champs :attribute et :other doivent être identiques.",
	"size"                 => [
		"numeric" => "La valeur de :attribute doit être :size.",
		"file"    => "La taille du fichier de :attribute doit être de :size kilo-octets.",
		"string"  => "Le texte de  :attribute doit contenir :size caractères.",
		"array"   => "Le tableau :attribute doit contenir :size éléments.",
	],
	"unique"               => "La valeur du champ :attribute est déjà utilisée.",
	"url"                  => "Le format de l'URL de :attribute n'est pas valide.",
	"timezone"             => "Le champ :attribute doit être un fuseau horaire valide.",

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
        "name" => "Nom",
        "firstName" => "Prénom",
        "emailAddress" => "Email",
        "dateOfBirth" => "Date de naissance",
        "isMale" => "Sexe",
        "nameOfTheRace" => "Nom",
        "distance" => "Distance",
        "city" => "Ville",
    ],

];
