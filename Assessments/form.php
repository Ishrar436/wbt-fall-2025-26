<!DOCTYPE HTML>
<html>

<head>

    <title>PHP Form Validation</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <?php
        $name1 = "";
        $name1Err = "";

        $email2 = "";
        $email2Err = "";

        $dd = $mm = $yyyy = "";
        $dobErr = "";

        $gender = "";
        $genderErr = "";

        $degree = [];
        $degreeErr = "";

        $blood = "";
        $bloodErr = "";

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $form_id = $_POST["form_id"] ?? "";

            if ($form_id === "task1") {
                if (empty($_POST["name1"])) {
                    $name1Err = "Name is required";
                } else {
                    $name1 = test_input($_POST["name1"]);

                    if (str_word_count($name1) < 2) {
                        $name1Err = "Name must contain at least two words";
                    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z .-]*$/", $name1)) {
                        $name1Err = "Must start with a letter and contain only letters, period, dash and spaces";
                    }
                }
            }

            if ($form_id === "task2") {
                if (empty($_POST["email2"])) {
                    $email2Err = "Email is required";
                } else {
                    $email2 = test_input($_POST["email2"]);
                    if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
                        $email2Err = "Invalid email format";
                    }
                }
            }

            if ($form_id === "task3") {
                $dd = test_input($_POST["dd"] ?? "");
                $mm = test_input($_POST["mm"] ?? "");
                $yyyy = test_input($_POST["yyyy"] ?? "");

                if ($dd === "" || $mm === "" || $yyyy === "") {
                    $dobErr = "Day, month and year are required";
                } elseif (!ctype_digit($dd) || !ctype_digit($mm) || !ctype_digit($yyyy)) {
                    $dobErr = "Date must be numeric";
                } else {
                    $dd_i = (int) $dd;
                    $mm_i = (int) $mm;
                    $yy_i = (int) $yyyy;

                    if (
                        $dd_i < 1 || $dd_i > 31 ||
                        $mm_i < 1 || $mm_i > 12 ||
                        $yy_i < 1953 || $yy_i > 1998
                    ) {
                        $dobErr = "dd: 1–31, mm: 1–12, yyyy: 1953–1998";
                    }
                }
            }


            if ($form_id === "task4") {
                if (empty($_POST["gender"])) {
                    $genderErr = "Please select at least one option";
                } else {
                    $gender = test_input($_POST["gender"]);
                }
            }


            if ($form_id === "task5") {
                if (empty($_POST["degree"])) {
                    $degreeErr = "Select at least two options";
                } else {
                    $degree = $_POST["degree"];
                    if (count($degree) < 2) {
                        $degreeErr = "Select at least two options";
                    } else {

                        $degree = array_map("test_input", $degree);
                    }
                }
            }


            if ($form_id === "task6") {
                if (empty($_POST["blood"])) {
                    $bloodErr = "You must select an option";
                } else {
                    $blood = test_input($_POST["blood"]);
                }
            }
        }
        ?>

        <h1>PHP Form Validation </h1>
        <p><small><span class="error">* required field</span></small></p>


        <h2>Task 1 – Name Validation</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="form_id" value="task1">

            <div class="field-row">
                <label for="name1">Full Name:</label>
                <input type="text" id="name1" name="name1" value="<?php echo $name1; ?>">
                <span class="error">*
                    <?php echo $name1Err; ?>
                </span>

            </div>
            <br>
            <input type="submit" value="Validate Name">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task1" && $name1Err == "" && $name1 !== "") {
            echo "<p class='success'>Valid name: $name1</p>";
        }
        ?>
        <br><br>


        <h2>Task 2 – Email Validation</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="form_id" value="task2">

            <div class="field-row">
                <label for="email2">Email:</label>
                <input type="text" id="email2" name="email2" value="<?php echo $email2; ?>">
                <span class="error">*
                    <?php echo $email2Err; ?>
                </span>
            </div>
            <br>
            <input type="submit" value="Validate Email">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task2" && $email2Err == "" && $email2 !== "") {
            echo "<p class='success'>Valid email: $email2</p>";
        }
        ?>
        <br><br>

        <h2>Task 3 – Date of Birth Validation</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="form_id" value="task3">

            <div class="field-row">
                <label>Date of Birth:</label>
                <input type="text" name="dd" size="2" placeholder="dd" value="<?php echo $dd; ?>"> /
                <input type="text" name="mm" size="2" placeholder="mm" value="<?php echo $mm; ?>"> /
                <input type="text" name="yyyy" size="4" placeholder="yyyy" value="<?php echo $yyyy; ?>">
                <span class="error">*
                    <?php echo $dobErr; ?>
                </span>
            </div>
            <br>
            <input type="submit" value="Validate DOB">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task3" && $dobErr == "" && $dd !== "" && $mm !== "" && $yyyy !== "") {
            echo "<p class='success'>Valid DOB: $dd/$mm/$yyyy</p>";
        }
        ?>
        <br><br>

        <h2>Task 4 – At Least One Option (Radio)</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="form_id" value="task4">

            <div class="field-row">
                <label>Gender:</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="Male" <?php if ($gender == "Male")
                        echo "checked"; ?>>
                        Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php if ($gender == "Female")
                        echo "checked"; ?>>
                        Female</label>
                    <label><input type="radio" name="gender" value="Other" <?php if ($gender == "Other")
                        echo "checked"; ?>>
                        Other</label>


                    <span class="error">*
                        <?php echo $genderErr; ?>
                    </span>
                </div>
            </div>
            <br>
            <input type="submit" value="Validate Gender">
        </form>
    </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task4" && $genderErr == "" && $gender !== "") {
        echo "<p class='success'>Selected gender: $gender</p>";
    }
    ?>
    <br><br>

    <h2>Task 5 – At Least Two Options (Checkbox)</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="form_id" value="task5">

        <div class="field-row">
            <label>Hobbies:</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="degree[]" value="SSC" <?php if (in_array("SSC", $degree))
                    echo "checked"; ?>> SSC
                </label>
                <label><input type="checkbox" name="degree[]" value="HSC" <?php if (in_array("HSC", $degree))
                    echo "checked"; ?>> HSC
                </label>
                <label><input type="checkbox" name="degree[]" value="Bsc" <?php if (in_array("Bsc", $degree))
                    echo "checked"; ?>> Bsc
                </label>
                <label><input type="checkbox" name="degree[]" value="Msc" <?php if (in_array("Msc", $degree))
                    echo "checked"; ?>> Msc
                </label>


                <span class="error">*
                    <?php echo $degreeErr; ?>
                </span>
            </div>
        </div>

        <br>
        <input type="submit" value="Validate Degree">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task5" && $degreeErr == "" && !empty($degree)) {
        echo "<p class='success'>Selected degrees: " . implode(", ", $degree) . "</p>";
    }
    ?>

    <br><br>

    <h2>Task 6 – Dropdown Must Be Selected</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="form_id" value="task6">

        <div class="field-row">
            <label for="blood">Blood Group:</label>
            <select name="blood" id="blood">
                <option value="">-- Select --</option>
                <option value="A+" <?php if ($blood == "A+")
                    echo "selected"; ?>>A+
                </option>
                <option value="A-" <?php if ($blood == "A-")
                    echo "selected"; ?>>A-
                </option>
                <option value="B+" <?php if ($blood == "B+")
                    echo "selected"; ?>>B+
                </option>
                <option value="B-" <?php if ($blood == "B-")
                    echo "selected"; ?>>B-
                </option>
                <option value="O+" <?php if ($blood == "O+")
                    echo "selected"; ?>>O+
                </option>
                <option value="O-" <?php if ($blood == "O-")
                    echo "selected"; ?>>O-
                </option>
                <option value="AB+" <?php if ($blood == "AB+")
                    echo "selected"; ?>>AB+
                </option>
                <option value="AB-" <?php if ($blood == "AB-")
                    echo "selected"; ?>>AB-
                </option>
            </select>
            <span class="error">*
                <?php echo $bloodErr; ?>
            </span>
        </div>

        <br>
        <input type="submit" value="Validate Blood Group">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && ($form_id ?? "") === "task6" && $bloodErr == "" && $blood !== "") {
        echo "<p class='success'>Selected blood group: $blood</p>";
    }
    ?>

    </div>
</body>

</html>