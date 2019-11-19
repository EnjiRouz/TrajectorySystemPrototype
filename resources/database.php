<?php
    $link=mysqli_connect('localhost',
                          'root','',
                        'education_programs');

    if (mysqli_connect_errno())
    {
        echo mysqli_connect_error();
        exit();
    }

    mysqli_set_charset($link,"utf8");


    $sql_requests = array(
                   // "SELECT * FROM `программы` WHERE `Блок`='Базовый'",
                    "SELECT * FROM `программы` WHERE `Блок`='Веб-программирование'",
                    "SELECT * FROM `программы` WHERE `Блок`='Разработка ПО'",
                    "SELECT * FROM `программы` WHERE `Блок`='Тестирование ПО'",
                    "SELECT * FROM `программы` WHERE `Блок`='Системный анализ'",
                );

    function get_programs_info($link,$sql_request){
        $result=mysqli_query($link,$sql_request);
        $programNames=mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $programNames;
    }

    function insert_chosen_programs($link){
        $email="john@doe.ya";
        $name= "Enji Rouz Inc";
        $direction="09.03.04 Программная инженерия";
        $chosenPrograms=$_POST['userData.chosenPrograms'];
        console.log($chosenPrograms);

        $email=mysqli_real_escape_string($link,$email);
        $check_email="SELECT * FROM `студенты` WHERE `Email`='$email'";
        $check_email_result=mysqli_query($link,$check_email);

        if(!mysqli_num_rows($check_email_result)){
            $sql_insert_request="INSERT INTO `студенты` (`Email`, `ФИО студента`, `Направление`, `Выбранные программы`) 
                                 VALUES (['$email'], ['$name'],['$direction'], ['$chosenPrograms'])";
            $result=mysqli_query($link, $sql_insert_request);
            return $result ? "created" : "creation failed";
        } else  {
            $sql_update_request="UPDATE `студенты` SET `Выбранные программы`=['$chosenPrograms']";
            $result=mysqli_query($link, $sql_update_request);
            return $result ? "updated" : "update failed";
        }
    }


