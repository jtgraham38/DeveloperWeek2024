<form action="{{ route('projects.store')}}" method="POST">
    <h3>Create Project</h3>
    <hr>
    @csrf
    <div class="flex flex-col">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" class="p-1" maxlength="255" required>
    </div>
    <div class="flex flex-col">
        <label for="name" class="block">Description:</label>
        <textarea type="text" name="description" placeholder="Enter project description here..." class="p-1 block text-zinc-900" maxlength="255" required></textarea>
    </div>

    <div class="text-zinc-900">
        <label class="text-zinc-200 block" for="state">Database Type:</label>
        <select name="db_type" class="p-1" required>

            <option class="text-zinc-200" value="0" disabled selected>Choose a database integration...</option>
            <option value="mysql">MySQL</option>
            <option value="sqlite">SQLite</option>
            <option value="sql_server">SQL Server</option>
            <option value="postgresql">PostgreSQL</option> 
        </select>
    </div>

    <div class="text-zinc-900">
        <label class="text-zinc-200 block" for="state">Output Type:</label>
        <select name="output_type" class="p-1" required>
            <option class="text-zinc-200" value="0" disabled selected>Choose an output api type...</option>
            <option value="flask">Flask</option>
        </select>
    </div>

    <button class="primary_btn mt-2"  type="submit">Create Project</button>
</form>