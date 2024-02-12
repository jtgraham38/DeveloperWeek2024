<form action="{{ route('projects.store')}}" method="POST" prompt="Sign Up">
    <h3>Create Project</h3>
    <hr>
    @csrf
    <div class="flex flex-col">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" class="p-1" maxlength="255" required>
    </div>
    <div class="flex flex-col">
        <label for="name">Description:</label>
        <input type="text" name="description" placeholder="Description" class="p-1" maxlength="255" required>
    </div>

    <br>

    <button class="primary_btn"  type="submit">Create Project</button>
</form>