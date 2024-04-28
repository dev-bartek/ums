<?php

namespace App\Livewire\Forms;

use App\Models\Address;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    public bool $creating = true;

    #[Validate('required|min:5|max:255|string')]
    public $name = '';

    public $email = '';

    #[Validate('required|string|max:255')]
    public $addressLine1 = '';

    #[Validate('string|max:255')]
    public $addressLine2 = '';

    #[Validate('string|max:255')]
    public $town = '';

    #[Validate('required|string|max:255')]
    public $city = '';

    #[Validate('required|string|max:255')]
    public $postcode = '';

    public function rules()
    {
        $rules = [
            'email' => [
                'required',
                'email',
            ],
        ];

        if ($this->creating) {
            $rules['email'][] = Rule::unique('users');
        } else {
            $rules['email'][] = Rule::unique('users')->ignore($this->user);
        }

        return $rules;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
        $address = $user->address;

        $this->name = $user->name;
        $this->email = $user->email;

        $this->addressLine1 = $address->address_line_1;
        $this->addressLine2 = $address->address_line_2;
        $this->town = $address->town;
        $this->city = $address->city;
        $this->postcode = $address->postcode;
    }

    /**
     * @throws ValidationException
     */
    public function store(): void
    {
        $this->creating = true;
        $this->validate();

        $user = User::create(
            $this->only([
                'name',
                'email',
            ])
        );

        $user->address()->create(
            array_merge([
                'address_line_1' => $this->addressLine1,
                'address_line_2' => $this->addressLine2,
            ],
                $this->only([
                    'town',
                    'city',
                    'postcode',
                ]))
        );

        $this->reset();
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        $this->creating = false;
        $this->validate();

        $this->user->update(
            $this->only([
                'name',
                'email',
            ])
        );

        $this->user->address()->update(
            array_merge([
                'address_line_1' => $this->addressLine1,
                'address_line_2' => $this->addressLine2,
            ],
                $this->only([
                    'town',
                    'city',
                    'postcode',
                ]))
        );
    }
}
