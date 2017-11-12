<div class="mt-element-list">
    <div class="mt-list-head list-simple font-white bg-green-sharp">
        <div class="list-head-title-container">
            <div class="list-date text-center"> FANAP ID : {{ $client->id }}</div>
            <h3 class="list-title">{{ ($client->firstname)?$client->firstname . ' ' . $client->lastname:'نام کاربر' }}</h3>
        </div>
    </div>
    <div class="mt-list-container list-simple">
        <ul>
            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-user"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> نام فارسی: </small> {{ ($client->firstname)?$client->firstname . ' ' . $client->lastname : 'وارد نشده است.'}}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-user"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> نام لاتین: </small> {{ ($client->firstname_latin)?$client->firstname_latin . ' ' . $client->lastname_latin : 'وارد نشده است.'}}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-credit-card"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> شماره حساب: </small> {{ ($client->account_number)?$client->account_number : 'وارد نشده است.' }}</p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-call-in"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> شماره موبایل: </small> {{ ($client->mobile)?$client->mobile : 'وارد نشده است.' }} </p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-user"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> شماره شناسنامه: </small> {{ ($client->identity_number)?$client->identity_number : 'وارد نشده است.' }} </p>
                    </h3>
                </div>
            </li>

            <li class="mt-list-item">
                <div class="list-icon-container">
                    <i class="icon-envelope"></i>
                </div>
                <div class="list-item-content">
                    <h3>
                        <p class="blue-hoki"><small class="font-grey-silver"> ادرس پست الکترونیکی: </small> {{ ($client->email)?$client->email : 'وارد نشده است.' }} </p>
                    </h3>
                </div>
            </li>
        </ul>
    </div>
</div>