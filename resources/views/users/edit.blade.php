<div class="p-2 card">
    <form action="{{ route('users.update', ['user'=>auth()->user()])}}" method="POST">
        <h3>Manage your account details:</h3>
        <hr>
        @csrf
        @method('PUT')
        <div>
            <div class="flex flex-row">
                <div class="mr-4">
                    <label for="name" class="block">First Name:</label>
                    <input type="text" name="first_name" value="{{$user->first_name}}" placeholder="First Name" class="p-1 block" maxlength="255" required>
                </div>
                <div>
                    <label for="name" class="block">Last Name:</label>
                    <input type="text" name="last_name" value="{{$user->last_name}}" placeholder="Last Name" class="p-1" maxlength="255" required>
                </div>
            </div>
        
            <div class="flex flex-row">
                <div class="mr-4">
                    <label for="name" class="block">Email:</label>
                    <input type="email" name="email" value="{{$user->email}}" placeholder="Email" class="p-1" maxlength="255" required>
                </div>
            
                <div class="">
                    <label for="phone_number" class="block">Phone:</label>
                    <input type="tel" name="phone_number" value="{{$user->phone_number}}" placeholder="Phone" class="p-1" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                </div>
            </div>
        
            <br>

            <div class="">
                <div class="flex flex-row">
                    <div class="mr-4">
                        <label for="street_address"  class="block">Street Address:</label>
                        <input type="text" name="street_address" value="{{$user->street_address}}" placeholder="Street Address" class="p-1" maxlength="255" required>
                    </div>
            
                    <div class="">
                        <label for="apt" class="block">Apt, suite, etc.:</label>
                        <input type="text" name="apt" value="{{$user->apt}}" placeholder="Apartment Number" class="p-1" maxlength="255">
                    </div>
                </div>
        
                <div class="flex flex-row">
                    <div class="mr-4">
                        <label for="city" class="block">City:</label>
                        <input type="text" name="city" value="{{$user->city}}" placeholder="City" class="p-1" maxlength="255" required>
                    </div>
            
                    <div class="inline-block text-zinc-900">
                        <label class="text-zinc-200 block" for="state">State:</label>
                        <select name="state" class="p-1" required>
                            
                            @php
                                $states = [
                                    "AL" => "Alabama",
                                    "AK" => "Alaska",
                                    "AZ" => "Arizona",
                                    "AR" => "Arkansas",
                                    "CA" => "California",
                                    "CO" => "Colorado",
                                    "CT" => "Connecticut",
                                    "DE" => "Delaware",
                                    "FL" => "Florida",
                                    "GA" => "Georgia",
                                    "HI" => "Hawaii",
                                    "ID" => "Idaho",
                                    "IL" => "Illinois",
                                    "IN" => "Indiana",
                                    "IA" => "Iowa",
                                    "KS" => "Kansas",
                                    "KY" => "Kentucky",
                                    "LA" => "Louisiana",
                                    "ME" => "Maine",
                                    "MD" => "Maryland",
                                    "MA" => "Massachusetts",
                                    "MI" => "Michigan",
                                    "MN" => "Minnesota",
                                    "MS" => "Mississippi",
                                    "MO" => "Missouri",
                                    "MT" => "Montana",
                                    "NE" => "Nebraska",
                                    "NV" => "Nevada",
                                    "NH" => "New Hampshire",
                                    "NJ" => "New Jersey",
                                    "NM" => "New Mexico",
                                    "NY" => "New York",
                                    "NC" => "North Carolina",
                                    "ND" => "North Dakota",
                                    "OH" => "Ohio",
                                    "OK" => "Oklahoma",
                                    "OR" => "Oregon",
                                    "PA" => "Pennsylvania",
                                    "RI" => "Rhode Island",
                                    "SC" => "South Carolina",
                                    "SD" => "South Dakota",
                                    "TN" => "Tennessee",
                                    "TX" => "Texas",
                                    "UT" => "Utah",
                                    "VT" => "Vermont",
                                    "VA" => "Virginia",
                                    "WA" => "Washington",
                                    "WV" => "West Virginia",
                                    "WI" => "Wisconsin",
                                    "WY" => "Wyoming",
                                ];
                            @endphp

                            <option class="text-zinc-200" value="0" disabled selected>Choose a state...</option>
                            <option value="AL" {{ $user->state == "AL" ? 'selected' : '' }}>Alabama</option>
                            @foreach($states as $state_code => $state_name)
                                <option value="{{ $state_code }}" {{ $user->state == $state_code ? 'selected' : '' }}>{{ $state_name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>

                <div class="">
                    <label for="zip_code" class="block">ZIP Code:</label>
                    <input type="text" name="zip_code" value="{{$user->zip_code}}" placeholder="ZIP Code" class="p-1" maxlength="255" required>
                </div>
            </div>
        </div>
        <br>

        <button class="primary_btn" type="submit">Save</button>
    </form>
</div>