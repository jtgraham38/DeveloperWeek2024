<div class="p-2 card">
    <form action="{{ route('users.update', ['user'=>auth()->user()])}}" method="POST">
        <h3>Manage your account details:</h3>
        <hr>
        @csrf
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <label for="name" class="block">First Name:</label>
                <input type="text" name="name" placeholder="First Name" class="p-1 block" maxlength="255" required>
            </div>
            <div class="sm:col-span-4">
                <label for="name" class="block">Last Name:</label>
                <input type="text" name="last_name" placeholder="Last Name" class="p-1" maxlength="255" required>
            </div>
        
            <div class="sm:col-span-4">
                <label for="name" class="block">Email:</label>
                <input type="email" name="email" placeholder="Email" class="p-1" maxlength="255" required>
            </div>
        
            <div class="sm:col-span-4">
                <label for="phone" class="block">Phone:</label>
                <input type="tel" name="phone" placeholder="Phone" class="p-1" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            </div>
        
        
            <div class="sm:col-span-4 gap-y-4">
                <div class="sm:col-span-4">
                    <label for="street_address" class="block">Street Address:</label>
                    <input type="text" name="street_address" placeholder="Street Address" class="p-1" maxlength="255" required>
                </div>
        
                <div class="sm:col-span-4">
                    <label for="apt" class="block">Apt, suite, etc.:</label>
                    <input type="text" name="apt" placeholder="Apartment Number" class="p-1" maxlength="255">
                </div>
        
                <div class="sm:col-span-4">
                    <label for="city" class="block">City:</label>
                    <input type="text" name="city" placeholder="City" class="p-1" maxlength="255" required>
                </div>
        
                <div class="sm:col-span-4">
                    <div class="inline-block text-zinc-900">
                        <label class="text-zinc-200 block" for="city">State:</label>
                        <select name="state" class="p-1" required>
                            <option class="text-zinc-200" value="0" disabled selected>Choose a state...</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
        
                    <div class="sm:col-span-4">
                        <label for="zip_code" class="block">ZIP Code:</label>
                        <input type="text" name="zip_code" placeholder="ZIP Code" class="p-1" maxlength="255" required>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <button class="primary_btn" type="submit">Save</button>
    </form>
</div>