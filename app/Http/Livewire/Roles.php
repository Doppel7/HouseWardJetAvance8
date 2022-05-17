<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;

class Roles extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.roles.view', [
            'roles' => Role::latest()
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
    }

    public function store()
    {
        $this->validate([
        ]);

        Role::create([ 
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Role Successfully created.');
    }

    public function edit($id)
    {
        $record = Role::findOrFail($id);

        $this->selected_id = $id; 
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        ]);

        if ($this->selected_id) {
			$record = Role::find($this->selected_id);
            $record->update([ 
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Role Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Role::where('id', $id);
            $record->delete();
        }
    }
}
