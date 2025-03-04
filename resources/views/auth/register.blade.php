<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl max-sm:max-w-lg mx-auto font-[sans-serif] p-6 border-white border-2 rounded-lg bg-white">
        <div class="text-center mb-12 sm:mb-16">
            <a href="javascript:void(0)">
                <img src="{{ asset('assets/images/logo.png' ) }}" alt="logo" class='w-40 inline-block' />
            </a>
            <h4 class="text-gray-600 text-base mt-6">Create an Account</h4>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">First Name</label>
                    <input type="text" name="firstname" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter first name" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Middle Name</label>
                    <input type="text" name="middlename" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter middle name" />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Last Name</label>
                    <input type="text" name="lastname" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter last name" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Email</label>
                    <input type="email" name="email" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter email" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Phone Number</label>
                    <input type="text" name="phone_number" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter phone number" required />
                </div>
                <div>
                    <label for="city" class="text-gray-600 text-sm mb-2 block">City</label>
                    <select id="city" name="city" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" required>
                        <option value="">Select City</option>
                    </select>
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Barangay</label>
                    <select name="barangay" id="barangay" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" required>
                        <option value="">Select Barangay</option>
                    </select>
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Street Address</label>
                    <input type="text" name="street_address" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter street address" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Zipcode</label>
                    <input type="text" name="zipcode" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter zipcode" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Username</label>
                    <input type="text" name="username" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" placeholder="Enter username" required />
                </div>
                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Password</label>
                    <input type="password" name="password"
                        class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
                        placeholder="Enter at least 8 characters" required />
                    <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters long.</p>
                </div>

                <div>
                    <label class="text-gray-600 text-sm mb-2 block">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all"
                        placeholder="Confirm password" required />
                </div>

            </div>

            <div class="mt-6">
                <label class="text-gray-600 text-sm mb-2 block">Role</label>
                <select name="role" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" required>
                    <option value="tenant">Tenant</option>
                    <option value="lessee">Lessee</option>
                    <option value="land_owner">Land Owner</option>
                    <option value="admin">Admin</option>
                    <!--                     <option value="superadmin">Super Admin</option> -->
                </select>
            </div>


            <div class="mt-6">
                <h3 class="font-bold text-lg text-gray-800">Profile Verification</h3>
                <div class="mt-2">
                    <label class="text-gray-600 text-sm mb-2 block">Valid ID</label>
                    <input type="file" name="valid_id" class="bg-gray-100 w-full text-gray-800 text-sm px-4 py-3 rounded focus:bg-transparent outline-blue-500 transition-all" required />
                </div>
                <div class="mt-4 relative">
                    <label class="text-gray-600 text-sm mb-2 block">Identity Recognition</label>

                    <!-- Camera Button -->
                    <button type="button" id="openCamera" class="flex items-center gap-2 bg-gray-600 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-camera"></i> Open Camera
                    </button>

                    <!-- Camera Modal -->
                    <div id="cameraModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                        <div class="bg-white p-4 rounded-lg shadow-lg w-96 text-center">
                            <h2 class="text-lg font-bold mb-2">Capture Image</h2>
                            <video id="video" class="w-full rounded-md"></video>
                            <canvas id="canvas" class="hidden"></canvas>

                            <div class="mt-4">
                                <button type="button" id="capture" class="bg-green-600 text-white px-4 py-2 rounded-md">
                                    <i class="fas fa-camera"></i> Capture
                                </button>
                                <button type="button" id="closeCamera" class="bg-red-600 text-white px-4 py-2 rounded-md">
                                    <i class="fas fa-times"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Captured Image Preview -->
                    <div id="capturedImagePreview" class="mt-4 hidden">
                        <h4 class="font-medium">Captured Image:</h4>
                        <img id="capturedImage" class="mt-2 w-32 h-32 object-cover rounded-md border"> <br>
                        <input type="file" id="identity_recognition" name="identity_recognition">
                    </div>
                </div>

            </div>

            <div class="mt-8">
                <button type="submit" class="w-full py-3 px-6 text-sm tracking-wider rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Sign up
                </button>
            </div>

        </form>
    </div>


    <!-- Add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        document.getElementById("openCamera").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission
            document.getElementById("cameraModal").classList.remove("hidden");

            let video = document.getElementById("video");
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    alert("Error accessing camera: " + err);
                });
        });

        document.getElementById("capture").addEventListener("click", function() {
            let video = document.getElementById("video");
            let canvas = document.getElementById("canvas");
            let context = canvas.getContext("2d");

            // Set canvas size and draw image
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.toBlob(function(blob) {
                let file = new File([blob], `identity_${Date.now()}.jpg`, {
                    type: "image/jpeg"
                });
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                let identityInput = document.getElementById("identity_recognition");
                identityInput.files = dataTransfer.files;
            }, "image/jpeg");
            document.getElementById("capturedImage").src = canvas.toDataURL("image/jpeg");
            document.getElementById("capturedImagePreview").classList.remove("hidden");
            document.getElementById("cameraModal").classList.add("hidden");
        });


        document.getElementById("closeCamera").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission

            document.getElementById("cameraModal").classList.add("hidden");
            let video = document.getElementById("video");
            let stream = video.srcObject;
            if (stream) {
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
            }
        });
        window.onload = function() {
            document.getElementById("capturedImagePreview").classList.add("hidden");
            document.getElementById("capturedImage").src = "";
            document.getElementById("identity_recognition").value = "";
        };
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const citySelect = document.getElementById("city");
            const barangaySelect = document.getElementById("barangay");

            // Load all cities on page load
            fetch("https://psgc.gitlab.io/api/cities/")
                .then((response) => response.json())
                .then((data) => {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    data.forEach((city) => {
                        let option = document.createElement("option");
                        option.value = city.code;
                        option.text = city.name;
                        citySelect.appendChild(option);
                    });
                });
            citySelect.addEventListener("change", function() {
                let cityCode = this.value;
                barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

                if (cityCode) {
                    fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays/`)
                        .then((response) => response.json())
                        .then((data) => {
                            data.forEach((barangay) => {
                                let option = document.createElement("option");
                                option.value = barangay.name;
                                option.text = barangay.name;
                                barangaySelect.appendChild(option);
                            });
                        })
                        .catch((error) =>
                            console.error("Error fetching barangays:", error)
                        );
                }
            });
        });
    </script>
</body>

</html>