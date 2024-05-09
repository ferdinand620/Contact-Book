<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactBook extends Component
{
    public $contacts;
    public $name;
    public $phone;
    public $selectedContactId;
    public $editname;
    public $editphone;
    public $show_edit_modal = false;

    public function Add()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Contact::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
        ]);

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->phone = '';
    }

    public function editContact($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        $this->selectedContactId = $contact->id;
        $this->editname = $contact->name;
        $this->editphone = $contact->phone;
    }

    public function updateContact()
    {
        $validatedData = $this->validate([
            'editname' => 'required',
            'editphone' => 'required',
        ]);

        $contact = Contact::findOrFail($this->selectedContactId);

        $contact->name = $validatedData['editname'];

        $contact->phone = $validatedData['editphone'];
        $contact->save();

        $this->resetEditFields();
        $this->loadContacts();
    }

    public function cancelEdit($isOpen)
    {
        $this->show_edit_modal = $isOpen;
        $this->name = '';
        $this->phone = '';
    }
    public function update()
    {
        $contact = Contact::findorfail($this->selectedContactId);
        $contact->name = $this->name;
        $contact->phone = $this->phone;
        $contact->save();
        $this->cancelEdit(false);
        $this->render();
    }

    private function resetEditFields()
    {
        $this->selectedContactId = null;
        $this->editname = '';
        $this->editphone = '';
    }

    public function editModal($isOpen, $contactID)
    {
        $this->selectedContactId = $contactID;
        $this->show_edit_modal = $isOpen;
        $Contact = Contact::findorfail($contactID);
        $this->name = $Contact->name;
        $this->phone = $Contact->phone;
    }

    public function deleteContact($contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $contact->delete();
    }


    public function render()
    {
        $this->contacts = Contact::all();

        return view('livewire.contact-book');
    }
}
