<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
	public $register = [
		'username' => 'required',
		'email' => 'required|valid_email',
		'password' => 'required|min_length[6]|matches[password2]',
		'password2' => 'required|min_length[6]',
		'gender' => 'required',
		'birthdate' => 'required'
	];
	
	public $register_errors = [
		'username' => [
			'required' => 'Username is required.'
		],
		'email' => [
			'required' => 'Email is required.',
			'valid_email' => 'Email is not valid.'
		],
		'password' => [
			'required' => 'Password is required.',
			'min_length' => 'Your new password must contain at least 6 characters.',
			'matches' => 'Your passwords don\'t match.'
		],
		'password2' => [
			'required' => 'Confirm Password is required.',
			'min_length' => 'Your confirm password must contain at least 6 characters.'
		],
		'gender' => [
			'required' => 'Gender is required.'
		],
		'birthdate' => [
			'required' => 'Birthdate is required.'
		]
	];
	
	public $forum = [
		'forum_title' => 'required',
		'subtitle' => 'required'
	];
	
	public $forum_errors = [
		'forum_title' => [
			'required' => 'Title is required.'
		],
		'subtitle' => [
			'required' => 'Subtitle is required.'
		]
	];
	
	public $thread = [
		'forum_id' => 'required',
		'user_id' => 'required',
		'title' => 'required',
		'content' => 'required',
	];
	
	public $thread_errors = [
		'forum_id' => [
			'required' => 'Forum Id is required.'
		],
		'user_id' => [
			'required' => 'User Id is required.'
		],
		'title' => [
			'required' => 'Title is required.'
		],
		'content' => [
			'required' => 'Content is required.'
		]
	];
	
	public $reply = [
		'thread_id' => 'required',
		'user_id' => 'required',
		'content' => 'required'
	];
	
	public $reply_errors = [
		'thread_id' => [
			'required' => 'Thread Id is required.'
		],
		'user_id' => [
			'required' => 'User Id is required.'
		],
		'content' => [
			'required' => 'Content is required.'
		]
	];
	
	public $user = [
		'username' => 'required',
		'email' => 'required|valid_email',
		'password' => 'required|min_length[6]',
		'gender' => 'required',
		'birthdate' => 'required'
	];
	
	public $user_errors = [
		'username' => [
			'required' => 'Username is required.'
		],
		'email' => [
			'required' => 'Email is required.',
			'valid_email' => 'Email is not valid.'
		],
		'password' => [
			'required' => 'Password is required.',
			'min_length' => 'Your new password must contain at least 6 characters.'
		],
		'gender' => [
			'required' => 'Gender is required.'
		],
		'birthdate' => [
			'required' => 'Birthdate is required.'
		]
	];
	
	public $forget = [
		'password' => 'required|min_length[6]|matches[password2]',
		'password2' => 'required|min_length[6]'
	];
	
	public $forget_errors = [
		'password' => [
			'required' => 'Password is required.',
			'min_length' => 'Your new password must contain at least 6 characters.',
			'matches' => 'Your passwords don\'t match.'
		],
		'password2' => [
			'required' => 'Confirm Password is required.',
			'min_length' => 'Your confirm password must contain at least 6 characters.'
		]
	];
	public $forgetProfile = [
			'oldPassword' => 'required|min_length[6]',
			'password' => 'required|min_length[6]|matches[password2]',
			'password2' => 'required|min_length[6]'
	];
}
