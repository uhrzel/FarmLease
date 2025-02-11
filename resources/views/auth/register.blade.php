<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-center text-2xl font-bold mb-6">Create Account</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name Fields -->
            <div class="grid grid-cols-3 gap-4">
                <div class="relative">
                    <label for="firstname" class="block font-medium">Firstname</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-500"></i>
                        <input id="firstname" type="text" name="firstname" required autofocus
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="relative">
                    <label for="middlename" class="block font-medium">Middle Name</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-500"></i>
                        <input id="middlename" type="text" name="middlename"
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="relative">
                    <label for="lastname" class="block font-medium">Lastname</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-500"></i>
                        <input id="lastname" type="text" name="lastname" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Contact Fields -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="relative">
                    <label for="email" class="block font-medium">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-500"></i>
                        <input id="email" type="email" name="email" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="relative">
                    <label for="phone_number" class="block font-medium">Phone Number</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-3 top-3 text-gray-500"></i>
                        <input id="phone_number" type="text" name="phone_number" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="relative">
                    <label for="city" class="block font-medium">City</label>
                    <div class="relative">
                        <i class="fas fa-city absolute left-3 top-3 text-gray-500"></i>
                        <select id="city" name="city" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Address Fields -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="relative">
                    <label for="barangay" class="block font-medium">Barangay</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-500"></i>
                        <select id="barangay" name="barangay" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Barangay</option>
                        </select>
                    </div>
                </div>

                <div class="relative">
                    <label for="street_address" class="block font-medium">Street Address</label>
                    <div class="relative">
                        <i class="fas fa-road absolute left-3 top-3 text-gray-500"></i>
                        <input id="street_address" type="text" name="street_address" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="relative">
                    <label for="zipcode" class="block font-medium">Zipcode</label>
                    <div class="relative">
                        <i class="fas fa-map-pin absolute left-3 top-3 text-gray-500"></i>
                        <input id="zipcode" type="text" name="zipcode" required
                            class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="mt-4 relative">
                <label for="username" class="block font-medium">Username</label>
                <div class="relative">
                    <i class="fas fa-user-circle absolute left-3 top-3 text-gray-500"></i>
                    <input id="username" type="text" name="username" required
                        class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-4 relative">
                <label for="password" class="block font-medium">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-500"></i>
                    <input id="password" type="password" name="password" required
                        class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-4 relative">
                <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-500"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="pl-10 p-2 border w-full rounded-md focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Profile Verification -->
            <div class="mt-6">
                <h3 class="font-bold text-lg">Profile Verification</h3>

                <div class="mt-2 relative">
                    <label for="valid_id" class="block font-medium">Valid ID</label>
                    <input type="file" id="valid_id" name="valid_id" class="border w-full p-2 rounded-md">
                </div>
                <div class="mt-4 relative">
                    <label class="block font-medium">Identity Recognition</label>

                    <!-- Camera Button -->
                    <button type="button" id="openCamera" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-md">
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
                        <img id="capturedImage" class="mt-2 w-32 h-32 object-cover rounded-md border">
                        <input type="file" id="identity_recognition" name="identity_recognition">
                    </div>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-user-plus"></i> SIGN UP
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

            // Convert canvas image to Blob (JPEG format)
            canvas.toBlob(function(blob) {
                let file = new File([blob], `identity_${Date.now()}.jpg`, {
                    type: "image/jpeg"
                });

                // Append file to FormData and update hidden input field
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                let identityInput = document.getElementById("identity_recognition");
                identityInput.files = dataTransfer.files;
            }, "image/jpeg");

            // Show the captured image
            document.getElementById("capturedImage").src = canvas.toDataURL("image/jpeg");
            document.getElementById("capturedImagePreview").classList.remove("hidden");

            // Close the modal
            document.getElementById("cameraModal").classList.add("hidden");
        });


        document.getElementById("closeCamera").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent form submission

            document.getElementById("cameraModal").classList.add("hidden");

            // Stop the camera stream
            let video = document.getElementById("video");
            let stream = video.srcObject;
            if (stream) {
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
            }
        });
        // Load saved image from local storage
        window.onload = function() {
            document.getElementById("capturedImagePreview").classList.add("hidden");
            document.getElementById("capturedImage").src = "";
            document.getElementById("identity_recognition").value = "";
        };



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
                        option.value = city.code; // Store city code
                        option.text = city.name;
                        citySelect.appendChild(option);
                    });
                });

            // Load barangays based on selected city
            citySelect.addEventListener("change", function() {
                let cityCode = this.value;
                barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangay dropdown

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