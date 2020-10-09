<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('active');
            $table->integer('user_id')->nullable()->default(0);
            $table->string('prefix', 20)->nullable();
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('suffix', 20)->nullable();
            $table->date('member_since_date')->nullable();
            $table->date('member_end_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->time('time_of_birth')->nullable();
            $table->string('place_of_birth', 50)->nullable();
            $table->timestamps();
        });

        /**
        CREATE TABLE `tblMembers` (
        `MemberID` int(11) NOT NULL AUTO_INCREMENT,
        `Active` tinyint(4) NOT NULL DEFAULT 1,
        `Member_Since_Date` date DEFAULT NULL,
        `Member_End_Date` datetime DEFAULT NULL,
        `Last_Name` varchar(50) DEFAULT NULL,
        `First_Name` varchar(50) DEFAULT NULL,
        `Middle_Name` varchar(50) DEFAULT NULL,
        `Suffix` varchar(20) DEFAULT NULL,
        `Title` varchar(20) DEFAULT NULL,
        `Address1` varchar(50) DEFAULT NULL,
        `Address2` varchar(50) DEFAULT NULL,
        `Magickal_Name` varchar(50) DEFAULT NULL,
        `City` varchar(50) DEFAULT NULL,
        `State` varchar(50) DEFAULT NULL,
        `Zip` varchar(20) DEFAULT NULL,
        `Home_Phone` varchar(30) DEFAULT NULL,
        `Work_Phone` varchar(30) DEFAULT NULL,
        `Cell_Phone` varchar(30) DEFAULT NULL,
        `Fax_Phone` varchar(20) DEFAULT NULL,
        `Primary_Phone` int(11) DEFAULT 1,
        `Email_Address` varchar(70) DEFAULT NULL,
        `Birth_Date` date DEFAULT NULL,
        `Birth_Time` varchar(20) DEFAULT NULL,
        `Birth_Place` varchar(50) DEFAULT NULL,
        `Degree` int(11) DEFAULT NULL,
        `First_Degree_Date` date DEFAULT NULL,
        `Second_Degree_Date` date DEFAULT NULL,
        `Third_Degree_Date` date DEFAULT NULL,
        `Fourth_Degree_Date` date DEFAULT NULL,
        `Fifth_Degree_Date` date DEFAULT NULL,
        `Bonded` tinyint(4) DEFAULT 0,
        `Bonded_Date` date DEFAULT NULL,
        `Solitary` tinyint(4) NOT NULL,
        `Solitary_Date` date DEFAULT NULL,
        `Coven` varchar(20) DEFAULT NULL,
        `LeadershipRole` varchar(20) DEFAULT NULL,
        `Leadership_Date` date DEFAULT NULL,
        `BoardRole` varchar(20) DEFAULT NULL,
        `BoardRole_Expiry_Date` date DEFAULT NULL,
        `Comments` longtext DEFAULT NULL,
        `UserLogon` varchar(20) DEFAULT NULL,
        `UserPassword` varchar(20) DEFAULT NULL,
        `InitialPassword` varchar(20) DEFAULT NULL,
        `Security_Question_ID` int(11) NOT NULL,
        `Security_Answer` varchar(30) DEFAULT NULL,
        `UserTimeZone` int(11) DEFAULT -5,
        `LoginEnabled` tinyint(4) DEFAULT 1,
        `LastOnlineTime` datetime DEFAULT NULL,
        `PasswordWarnings` int(11) NOT NULL DEFAULT 0,
        PRIMARY KEY (`MemberID`),
        UNIQUE KEY `UserLogon` (`UserLogon`)
        ) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=latin1;
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
}
