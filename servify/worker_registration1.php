
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Registration</title>
    <style>
        body {
            /* background-image: url('https://img.freepik.com/free-vector/abstract-paper-cut-banner-template-backgrounds-paper-cut-shapes-template-banner_1142-9712.jpg?w=1060&t=st=1727855579~exp=1727856179~hmac=83486aa4df230797b1e57cdf4eb4fa0e3f4c9bc63f3d7ac894b96d5d56eb3f2b'); */
            background-image: url('https://images.pexels.com/photos/1022923/pexels-photo-1022923.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-image: linear-gradient(270deg, #ffecd2, #fcb69f, #ff9a8b, #fcb69f); */
            background-blend-mode: multiply,multiply;        }
        .container {
            /* background-color: rgba(255, 255, 255, 0.9); Slightly more opaque */
            background-color:white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        letter-spacing: 1px;
        font-size: 2em;
        /* Gradient text animation */
        background: linear-gradient(90deg, #ff7e5f, #feb47b, #86a8e7, #91eae4);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 5s ease-in-out infinite, fadeInText 2s ease-in-out;
    }

    /* Color-shifting gradient animation */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Fade-in animation */
    @keyframes fadeInText {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
        label {
            font-weight: 500;
            color: #555;
        }
        .btn-primary {
            width: 30%;
            background-color:00BFFF; 
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        input[type="radio"] {
            margin-left: 10px;
            margin-right: 5px;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        
        

    </style>
    <script>
        const districtToPlaces = {
            "Thiruvananthapuram": ["Kovalam", "Poojappura", "Kaniyapuram", "Attingal", "Neyyattinkara", "Varkala", "Karamana", "Vizhinjam", "Kazhakkoottam", "Balaramapuram", "Kattakada", "Nedumangad", "Chirayinkeezhu", "Pangode"],
            "Kollam": ["Ashtamudi", "Kollam City", "Paravur", "Karunagappally", "Punalur", "Chavara", "Kottarakkara", "Anchal", "Pathanapuram", "Kundara", "Sasthamkotta", "Oachira", "Kunnathur", "Chathannoor"],
            "Pathanamthitta": ["Thiruvalla", "Pathanamthitta City", "Ranni", "Adoor", "Pandalam", "Konni", "Mallappally", "Kozhencherry", "Chengannur", "Aranmula", "Omallur", "Perunad", "Niranam"],
            "Alappuzha": ["Alleppey", "Cherthala", "Ambalappuzha", "Haripad", "Kayamkulam", "Mavelikkara", "Mararikulam", "Kuttanad", "Chengannur", "Mannanchery", "Thumpoly", "Punnapra", "Ezhupunna"],
            "Kottayam": ["Kottayam City", "Changanassery", "Puthuppally", "Ettumanoor", "Pala", "Vaikom", "Kanjirappally", "Erattupetta", "Mundakayam", "Thiruvalla", "Kumarakom", "Uzhavoor", "Manarcaud"],
            "Idukki": ["Munnar", "Thekkady", "Neriamangalam", "Thodupuzha", "Kattappana", "Adimali", "Kumily", "Cheruthoni", "Vandiperiyar", "Devikulam", "Peermade", "Rajakkad", "Vazhathope"],
            "Ernakulam": ["Kochi", "Muvattupuzha", "Aluva", "Angamaly", "Perumbavoor", "North Paravur", "Tripunithura", "Kakkanad", "Fort Kochi", "Kalady", "Kothamangalam", "Maradu", "Mattancherry"],
            "Thrissur": ["Thrissur City", "Guruvayoor", "Chalakudy", "Irinjalakuda", "Kodungallur", "Kunnamkulam", "Ollur", "Pudukad", "Chavakkad", "Wadakkanchery", "Mullurkara", "Cherpu", "Anthikad"],
            "Palakkad": ["Palakkad City", "Mannarkkad", "Ottappalam", "Shoranur", "Alathur", "Chittur", "Pattambi", "Nenmara", "Kanjirapuzha", "Malampuzha", "Muthalamada", "Kollengode"],
            "Malappuram": ["Malappuram City", "Kondotty", "Perinthalmanna", "Manjeri", "Ponnani", "Tirur", "Nilambur", "Edappal", "Kottakkal", "Tanur", "Areekode", "Vengara"],
            "Kozhikode": ["Kozhikode City", "Koyilandy", "Vatakara", "Thamarassery", "Balussery", "Feroke", "Kunnamangalam", "Nadapuram", "Beypore", "Koduvally", "Mukkam", "Kappad", "Kuttiady"],
            "Wayanad": ["Kalpetta", "Mananthavady", "Sultan Bathery", "Meppadi", "Vythiri", "Ambalavayal", "Panamaram", "Pulpally", "Thirunelli", "Tholpetty", "Kattikkulam", "Lakkidi"],
            "Kannur": ["Kannur City", "Thalassery", "Iritty", "Payyannur", "Mattannur", "Panoor", "Azhikode", "Kuthuparamba", "Anjarakandy", "Valapattanam", "Sreekandapuram", "Edakkad"],
            "Kasargod": ["Kasargod City", "Kanjangad", "Payyannur", "Nileshwaram", "Cheruvathur", "Uduma", "Manjeshwar", "Trikaripur", "Badiyadka", "Periya", "Puthur", "Kumbla"]
        };
        const workerTypes = {
            "Skilled Workers": ["Electrician", "Plumber", "Carpenter", "Mechanic", "Welder", "Mason"],
            "Unskilled Workers": ["Laborer", "Helper", "Cleaning Staff", "Delivery Worker"],
            "Service Workers": ["Food Service Worker", "Personal Care Aide", "Childcare Provider", "Security Guard"],
            "Creative Workers": ["Artist", "Musician", "Writer", "Photographer"],
            "Healthcare Workers": ["Nurse", "Doctor", "Therapist", "Pharmacist"]
        };

        function updatePlaces() {
            const districtSelect = document.getElementById("district");
            const placeSelect = document.getElementById("place");
            const selectedDistrict = districtSelect.value;

            // Clear previous options
            placeSelect.innerHTML = '<option value="">Select your place</option>';

            if (selectedDistrict) {
                const places = districtToPlaces[selectedDistrict];
                places.forEach(place => {
                    const option = document.createElement("option");
                    option.value = place;
                    option.textContent = place;
                    placeSelect.appendChild(option);
                });
            }
        }
        function updateWorkerTypes() {
            const workerTypeSelect = document.getElementById("workerType");
            const specificWorkerSelect = document.getElementById("specificWorker");
            const selectedType = workerTypeSelect.value;

            // Clear previous options
            specificWorkerSelect.innerHTML = '<option value="">Select Worker</option>';

            if (selectedType) {
                const workers = workerTypes[selectedType];
                workers.forEach(worker => {
                    const option = document.createElement("option");
                    option.value = worker;
                    option.textContent = worker;
                    specificWorkerSelect.appendChild(option);
                });
            }
        }

        const idProofPatterns = {
            "Aadhar": "[0-9]{12}", // Aadhar number should be 12 digits
            "Voter ID": "[A-Z0-9]{10}", // Example format for Voter ID
            "Pancard": "[A-Z]{5}[0-9]{4}[A-Z]{1}", // PAN card pattern (5 letters, 4 digits, 1 letter)
            "Passport": "[A-Z]{1}[0-9]{7}", // Passport should start with a letter followed by 7 digits
        };

        function updateIdProofPattern() {
            const idProofSelect = document.getElementById("idproof");
            const idNumberInput = document.getElementById("idnumber");
            const selectedIdProof = idProofSelect.value;

            // Set the pattern based on selected ID proof
            idNumberInput.setAttribute("pattern", idProofPatterns[selectedIdProof] || "");
        }
    </script>
</head>
<body>
<video autoplay muted loop class="video-background">
        <!-- <source src="https://videos.pexels.com/video-files/8964292/8964292-uhd_2560_1440_25fps.mp4" type="video/mp4"> -->

    </video>
    <div class="container mt-5">
        <h1>WORKER REGISTRATION</h1>
        <form action="#" method="post">
            <table class="table table-borderless">
                <tr>
                    <td><label for="name">Name</label></td>
                    <td><input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required></td>
                </tr>
                <tr>
                    <td><label for="phonenumber">Phone Number</label></td>
                    <td><input type="tel" id="phonenumber" name="phonenumber" class="form-control"  required pattern="[0-9]{10}" maxlength="10" placeholder="Enter Phone numebr"></td>
                </tr>
                <tr>
                    <td><label for="address">Address</label></td>
                    <td><textarea id="address" name="address" class="form-control" rows="2" placeholder="Enter Address" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="pincode">Pincode</label></td>
                    <td><input type="tel" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode" required pattern="[0-9]{6}" maxlength="6"></td>
                </tr>
                <tr>
                    <td><label for="district">District</label></td>
                    <td>
                        <select id="district" name="district" class="form-select" onchange="updatePlaces()" required>
                            <option value="">Select your district</option>
                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                            <option value="Kollam">Kollam</option>
                            <option value="Pathanamthitta">Pathanamthitta</option>
                            <option value="Alappuzha">Alappuzha</option>
                            <option value="Kottayam">Kottayam</option>
                            <option value="Idukki">Idukki</option>
                            <option value="Ernakulam">Ernakulam</option>
                            <option value="Thrissur">Thrissur</option>
                            <option value="Palakkad">Palakkad</option>
                            <option value="Malappuram">Malappuram</option>
                            <option value="Kozhikode">Kozhikode</option>
                            <option value="Wayanad">Wayanad</option>
                            <option value="Kannur">Kannur</option>
                            <option value="Kasargod">Kasargod</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="place">Place</label></td>
                    <td>
                        <select id="place" name="place" class="form-select" required>
                            <option value="">Select your place</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" id="male" name="gender" value="male" required>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female" required>
                        <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="workerType">Worker Type</label></td>
                    <td>
                        <select id="workerType" name="workertype" class="form-select" onchange="updateWorkerTypes()" required>
                            <option value="">Select Worker Type</option>
                            <option value="Skilled Workers">Skilled Workers</option>
                            <option value="Unskilled Workers">Unskilled Workers</option>
                            <option value="Service Workers">Service Workers</option>
                            <option value="Creative Workers">Creative Workers</option>
                            <option value="Healthcare Workers">Healthcare Workers</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="specificWorker">Specific Worker</label></td>
                    <td>
                        <select id="specificWorker" name="specificworker" class="form-select" required>
                            <option value="">Select Worker</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="idproof">ID Proof</label></td>
                    <td>
                        <select id="idproof" name="idproof" class="form-select" onchange="updateIdProofPattern()" required>
                            <option value="">Select ID Proof</option>
                            <option value="Aadhar">Aadhar</option>
                            <option value="Voter ID">Voter ID</option>
                            <option value="Pancard">Pancard</option>
                            <option value="Passport">Passport</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="idnumber">ID Number</label></td>
                    <td><input type="text" id="idnumber" name="idnumber" class="form-control" required placeholder="Enter ID Number"></td>
                </tr>

                <tr>
    <td><label for="password">Password</label></td>
    <td><input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required></td>
</tr>
<tr>
    <td><label for="confirm_password">Confirm Password</label></td>
    <td><input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required></td>
</tr>

                <tr>
                 <td></td><td colspan="2">
                        <button type="submit" name="submit" class="btn btn-primary mt-3">REGISTER</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $conn = mysqli_connect("localhost", "root", "", "servify");
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $address = $_POST["address"];
    $pincode = $_POST["pincode"];
    $district = $_POST["district"];
    $place = $_POST["place"];
    $gender = $_POST["gender"];
    $workertype = $_POST["workertype"];
    $specificworker = $_POST["specificworker"];
    $idproof = $_POST["idproof"];
    $idnumber = $_POST["idnumber"];
    $password = $_POST["password"];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        echo "Error: Password and Confirm Password do not match.";
    } else {
        // Insert into the worker_registration1 table
        $sql = "INSERT INTO worker_registration1 (name, email, phonenumber, address, pincode, district, place, gender, workertype, specificworker, idproof, idnumber, password, type) 
                VALUES ('$name', '$email', '$phonenumber', '$address', '$pincode', '$district', '$place', '$gender', '$workertype', '$specificworker', '$idproof', '$idnumber', '$password', 'user')";
        
        if (mysqli_query($conn, $sql)) {
            // Insert email and password into the login table with status and type
            $login_sql = "INSERT INTO login (email, password, status, type) VALUES ('$email', '$password', '1', 'worker')";
            if (mysqli_query($conn, $login_sql)) {
                echo '<script type="text/javascript">alert("Registration completed");window.location.href = "login.php"; </script>';
            } else {
                echo "Error inserting into login table: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting into worker_registration1 table: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

