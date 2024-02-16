<div class="p-2 card">
    <form action="{{ route('projects.update', ['project' => $project])}}" method="POST">
        <h3>Project Settings</h3>
        <hr>
        @csrf
        @method('PUT')
        <div class="">
            <label for="name" class="block">Name:</label>
            <input type="text" name="name" value="{{$project->name}}" placeholder="Name" class="p-1 block" maxlength="255" required>
        </div>
        <div class="">
            <label for="name" class="block">Description:</label>
            <textarea type="text" name="description" placeholder="Enter project description here..." class="p-1 block text-zinc-900" maxlength="255" required>{{$project->description}}</textarea>
        </div>

        <div class="text-zinc-900">
            <label class="text-zinc-200 block" for="state">Database Type:</label>
            <select name="db_type" class="p-1 block" required>

                @php
                    $databases = [
                        "mysql" => "MySQL",
                        "sqlite" => "SQLite",
                        "sql_server" => "SQL Server",
                        "postgresql" => "PostgreSQL",
                    ];
                @endphp

                <option class="text-zinc-200" value="0" disabled>Choose a database integration...</option>
                @foreach($databases as $db_code => $db_name)
                    <option value="{{ $db_code }}" {{ $project->db_type == $db_code ? 'selected' : '' }}>{{ $db_name }}</option>
                @endforeach> 
            </select>
            
        </div>

        <div class="text-zinc-900">
            <label class="text-zinc-200 block" for="state">Output Type:</label>
            <select name="output_type" class="p-1" required>
                <option class="text-zinc-200" value="0" disabled selected>Choose an output api type...</option>
                <option value="flask" {{ $project->output_type == $db_code ? 'flask' : '' }}>Flask</option>
            </select>
        </div>

        <button class="primary_btn mt-2"  type="submit">Save</button>
    </form>
</div>