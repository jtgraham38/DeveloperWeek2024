<form action="{{ route('users.store')}}" method="POST">
    <h3>Sign Up</h3>
    <hr>
    @csrf
    <div class="flex flex-col">
        <label for="name">First Name:</label>
        <input type="text" name="first_name" placeholder="First Name" class="p-1" maxlength="255" required>
    </div>

    <div class="flex flex-col">
        <label for="name">Last Name:</label>
        <input type="text" name="last_name" placeholder="Last Name" class="p-1" maxlength="255" required>
    </div>

    <div class="flex flex-col">
        <label for="name">Email:</label>
        <input type="email" name="email" placeholder="Email" class="p-1" maxlength="255" required>
    </div>

    <div class="flex flex-col">
        <label for="phone">Phone:</label>
        <input type="tel" name="phone" placeholder="Phone" class="p-1" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
    </div>

    <div class="flex flex-col space-y-6">
        <div class="flex flex-col">
            <label for="street_address">Street Address:</label>
            <input type="text" name="street_address" placeholder="Street Address" class="p-1" maxlength="255" required>
        </div>

        <div class="flex flex-col">
            <label for="apt">Apt, suite, etc.:</label>
            <input type="text" name="apt" placeholder="Apartment Number" class="p-1" maxlength="255">
        </div>

        <div class="flex flex-col">
            <label for="city">City:</label>
            <input type="text" name="city" placeholder="City" class="p-1" maxlength="255" required>
        </div>

        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <label for="city">State:</label>
                <select name="state" class="p-1" required>
                    <option value="0" disabled selected>Choose a state...</option>
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

            <div class="flex flex-col">
                <label for="zip_code">ZIP Code:</label>
                <input type="text" name="zip_code" placeholder="ZIP Code" class="p-1" maxlength="255" required>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <label for="name">Password:</label>
        <input type="password" name="password" placeholder="Password" class="p-1" minlength="6" required>
    </div>
    <div class="flex flex-col">
        <label for="name">Confirm Password:</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="p-1" minlength="6" required>
    </div>

    <button class="primary_btn w-full"  type="submit">Sign Up</button>
</form>
