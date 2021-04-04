<?php

class profil_admin {
//put your code here
    const host_name="localhost";
    const user="root";
    const pass="";
    const db_name="projekat";

    private $dbh;
    
    function __construct() {
        try {
            $this->dbh=new PDO("mysql:host=".self::host_name.";dbname=".self::db_name, self::user, self::pass);
            
            
        } catch (PDOException $e) {
            echo "Greška!";
            echo $e->getMessage();
           }
        }
    function __destruct() {
        $this->dbh=NULL;
    }
    
    public function stampajKorisnike($nazivKriterijuma=NULL){
        try{
            $sql="select id_user,name,email,username,password,reg_date,ifnull(stanje,0) as stanje from login";
            
            if(isset($nazivKriterijuma)){
                $sql.=" where name like '%$nazivKriterijuma%'";
            }
            $pdo_izraz= $this->dbh->query($sql);
            $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;'>";
            echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>ImePrezime</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Imejl</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Korisničko ime</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum registracije</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Trenutno stanje</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;' colspan='2'>&nbsp;</th></tr>";
            
                foreach ($niz as $korisnik){
                    echo "<tr><td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["id_user"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["name"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["email"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["username"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["password"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["reg_date"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["stanje"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='brisi.php?id=".$korisnik['id_user']."' onclick='return brisi(this.id)'><img src='pictures/trashcan.png'"
                            ."width='25' height='25' alt='obrisi' title='briši'></a></td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='izmeni.php?id=".$korisnik['id_user']."'><img src='pictures/update.png' width='25'height='25' alt='izmeni' title='izmeni'></a></td></tr>";
                }
                
            echo "</table>";
            
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
        }
       
    }
    public function stampajAdministratore($nazivKriterijuma=NULL,$id){
        try{
            $sql="select id_user,name,email,username,password,reg_date from login_admin";
            
            if(isset($nazivKriterijuma)){
                $sql.=" where name like '%$nazivKriterijuma%'";
            }
            $pdo_izraz= $this->dbh->query($sql);
            $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;'>";
            echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>ImePrezime</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Imejl</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Korisničko ime</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum registracije</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;' colspan='2'>&nbsp;</th></tr>";
            
                foreach ($niz as $korisnik){
                    echo "<tr><td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["id_user"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["name"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["email"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["username"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["password"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["reg_date"]."</td>";
                    if($korisnik["id_user"]===$id){
                        echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;' colspan='2'>&nbsp;</td>";
                    }
                    else{
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='brisi-admin.php?id=".$korisnik['id_user']."' onclick='return brisi(this.id)'><img src='pictures/trashcan.png'"
                            ."width='25' height='25' alt='obrisi' title='briši'></a></td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='izmeni-admin.php?id=".$korisnik['id_user']."'><img src='pictures/update.png' width='25'height='25' alt='izmeni' title='izmeni'></a></td></tr>";
                    }
                }
                
            echo "</table>";
            
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
        }
    }
    public function stampajAranzmane($nazivKriterijuma=NULL){
        try{
            $sql="select id,ponude,agencija,grad,tip_smestaja,prevoz,datum_polaska,cena from aranzman";
            
            if(isset($nazivKriterijuma)){
                $sql.=" where grad like '%$nazivKriterijuma%'";
            }
            $pdo_izraz= $this->dbh->query($sql);
            $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<table width=100% style='border-collapse:collapse; background-color:#e5e5e5;'>";
            echo "<tr><th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Šifra</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Grad</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Agencija</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip ponude</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Tip smeštaja</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Prevoz</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Datum polaska</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>Cena</th>";
            echo "<th style='padding:8px; text-align:left; border-bottom:1px solid #ddd;' colspan='2'>&nbsp;</th></tr>";
            
                foreach ($niz as $korisnik){
                    echo "<tr><td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["id"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["grad"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["agencija"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["ponude"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["tip_smestaja"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["prevoz"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["datum_polaska"]."</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'>".$korisnik["cena"]."din.</td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='brisi-aranzmane.php?id=".$korisnik['id']."' onclick='return brisi(this.id)'><img src='pictures/trashcan.png'"
                            ."width='25' height='25' alt='obrisi' title='briši'></a></td>";
                    echo "<td style='padding:8px; text-align:left; border-bottom:1px solid #ddd;'><a href='izmeni-aranzmane.php?id=".$korisnik['id']."'><img src='pictures/update.png' width='25'height='25' alt='izmeni' title='izmeni'></a></td></tr>";
                }
                
            echo "</table>";
            
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
        }
    }

    public function dodaj_korisnika($imePrezime,$email,$username,$pass,$table){
        try{
            $sql="insert into ".$table."(name,email,username,password)";
            $sql.="values('$imePrezime','$email','$username','$pass')";
            $pdo_izrar= $this->dbh->exec($sql);
            return true;
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function brisi($id,$table){
        try{
            $sql="delete from ".$table." where id_user=".$id;
            $pdo_izraz= $this->dbh->exec($sql);
            return true;
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function brisi_korisnik($id){
        try{
            $sql="select * from narudzbenica where idKupac=".$id;
            $sql2="delete from narudzbenica where idKupac=".$id;
            $sql3="delete from login where id_user=".$id;
            
            
            $pdo_izraz=$this->dbh->query($sql);
            $rows=$pdo_izraz->rowCount();
            
            if($rows>0){
                $pdo_izraz2= $this->dbh->exec($sql2);
                $pdo_izraz3= $this->dbh->exec($sql3);
                return true;
                
            }
            else{
                $pdo_izraz1= $this->dbh->exec($sql3);
                return true;
            }
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function brisi_aranzman($id){
        try{
            $sql1="select * from narudzbenica where idAranzman=".$id;
            $sql3="delete from narudzbenica where idAranzman=".$id;
            $sql="delete from aranzman where id=$id";
            
           $pdo_izraz=$this->dbh->query($sql1);
            $rows=$pdo_izraz->rowCount();
            
            if($rows>0){
                $pdo_izraz2= $this->dbh->exec($sql3);
                $pdo_izraz3= $this->dbh->exec($sql);
                return true;
                
            }
            else{
                $pdo_izraz1= $this->dbh->exec($sql);
                return true;
            }
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function dodaj_aranzman($ponude,$agencija,$grad,$tip,$prevoz,$datum_polaska,$cena){
        try{
            $sql="insert into aranzman(ponude,agencija,grad,tip_smestaja,prevoz,datum_polaska,cena)";
            $sql.="values('$ponude','$agencija','$grad','$tip','$prevoz','$datum_polaska','$cena')";
            $pdo_izrar= $this->dbh->exec($sql);
            return true;
        }
        catch (PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function izmeni_aranzman($id,$ponude,$agencija,$grad,$tip,$prevoz,$datum_polaska,$cena){
        try{
            $sql="update aranzman set ponude=:ponude,";
            $sql.="agencija=:agencija,grad=:grad,tip_smestaja=:tip,prevoz=:prevoz,datum_polaska=:datum_polaska,cena=:cena ";
            $sql.="where id=:id";
            
            $pdo_izraz= $this->dbh->prepare($sql);
            $pdo_izraz->bindParam(':id', $id);
            $pdo_izraz->bindParam(':ponude', $ponude);
            $pdo_izraz->bindParam(':agencija', $agencija);
            $pdo_izraz->bindParam(':grad', $grad);
            $pdo_izraz->bindParam(':tip', $tip);
            $pdo_izraz->bindParam(':prevoz', $prevoz);
            $pdo_izraz->bindParam(':datum_polaska', $datum_polaska);
            $pdo_izraz->bindParam(':cena', $cena);
            $pdo_izraz->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function izmeni_korisnik($id,$name,$email,$username,$stanje){
        try{
            $sql="update login set name=:name,email=:email,";
            $sql.="username=:username,stanje=:stanje ";
            $sql.="where id_user=:id";
            
            $pdo_izraz= $this->dbh->prepare($sql);
            $pdo_izraz->bindParam(':id', $id);
            $pdo_izraz->bindParam(':name', $name);
            $pdo_izraz->bindParam(':email', $email);
            $pdo_izraz->bindParam(':username', $username);
            $pdo_izraz->bindParam(':stanje', $stanje);
            $pdo_izraz->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function izmeni_admin($id,$name,$email,$username){
        try{
            $sql="update login_admin set name=:name,email=:email,";
            $sql.="username=:username ";
            $sql.="where id_user=:id";
            
            $pdo_izraz= $this->dbh->prepare($sql);
            $pdo_izraz->bindParam(':id', $id);
            $pdo_izraz->bindParam(':name', $name);
            $pdo_izraz->bindParam(':email', $email);
            $pdo_izraz->bindParam(':username', $username);
            $pdo_izraz->execute();
            return true;
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function uzmiPodatke($id){
        try{
        $sql="select id_user,name,email,username,ifnull(stanje,0) as stanje from login where id_user='$id'";
        
        $pdo_izraz= $this->dbh->query($sql);
        $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
        
        return $niz;
        
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
        
    }
    public function uzmiPodatkeAdmin($id){
        try{
        $sql="select id_user,name,email,username from login_admin where id_user='$id'";
        
        $pdo_izraz= $this->dbh->query($sql);
        $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
        
        return $niz;
        
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    public function uzmiPodatkeAranzman($id){
        try{
        $sql="select id,ponude,agencija,grad,tip_smestaja,prevoz,datum_polaska,cena from aranzman where id='$id'";
        
        $pdo_izraz= $this->dbh->query($sql);
        $niz=$pdo_izraz->fetchAll(PDO::FETCH_ASSOC);
        
        return $niz;
        
        }
        catch(PDOException $e){
            echo "Greška!";
            echo $e->getMessage();
            return false;
        }
    }
    
}
