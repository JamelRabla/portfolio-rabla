<?php

class Database
{
    private $sql;

    public function __construct()
    {
        define('SHOST', 'localhost'); // Hôte de la base de données
        define('SUSER', 'root'); // Nom d'utilisateur de la base de données
        define('SPWD', ''); // Mot de passe de la base de données
        define('SDB', 'fugue'); // Nom de la base de données
        define('SPORT', '3306'); // Port de la bdd

        $this->connect();
    }

    private function connect()
    {
        try {
            $this->sql = new PDO("mysql:host=".SHOST.";port=".SPORT.";dbname=".SDB, SUSER, SPWD);
            $this->sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->sql->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getSql()
    {
        return $this->sql;
    }
}

class UserHandler
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function loginUser($mail, $password)
    {
        $sql = $this->db->getSql();

        $requete = "SELECT * FROM UTILISATEUR WHERE MAIL_USER = :MAIL";

        $result = $sql->prepare($requete);
        $result->bindValue(':MAIL', strtolower($mail));
        $result->execute();
        $result = $result->fetch();

        if (!empty($result)) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                if (password_verify($password, $result['MDP'])) {

                    $_SESSION['user'] = [
                        'token' => $result['TOKEN_USER'],
                        'firstname' => $result['NOM_USER'],
                        'lastname' => $result['PRENOM_USER'],
                    ];

                    header('Location: ./admin.php');
                    exit();
                } else {
                    header('Location: ./login.php?err=password');
                    exit();
                }
            } else {
                header('Location: ./login.php?err=email');
                exit();
            }
        } else {
            header('Location: ./login.php?err=none');
            exit();
        }
    }

    public function createUser($lastname, $firstname, $mail, $password, $password_validation)
    {
        $sql = $this->db->getSql();

        if (isset($lastname, $firstname, $mail, $password, $password_validation)) {
            // Vérifier si l'utilisateur existe déjà.
            $requete = "SELECT COUNT(*) FROM UTILISATEUR WHERE MAIL_USER = :MAIL";
            $result = $sql->prepare($requete);
            $result->execute([':MAIL' => strtolower($mail)]);
            $count = $result->fetchColumn();

            // Si l'utilisateur n'existe pas.
            if ($count == 0) {
                if (strlen($mail) <= 100) {
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        if ($password === $password_validation) {
                            // Hasher le mot de passe avec Bcrypt, avec un coût de 12.
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                            // Ajouter l'utilisateur à la base de données.
                            $requete = "INSERT INTO UTILISATEUR (NOM_USER, PRENOM_USER, MAIL_USER, MDP, TOKEN_USER)
                                        VALUES (:NOM, :PRENOM, :MAIL, :PASSWORD, :TOKEN)";
                            $result = $sql->prepare($requete);
                            $result->execute([
                                ':NOM' => $lastname,
                                ':PRENOM' => $firstname,
                                ':MAIL' => $mail,
                                ':PASSWORD' => $password,
                                ':TOKEN' => bin2hex(openssl_random_pseudo_bytes(64))
                            ]);

                            // Rediriger vers la page de connexion
                            header('Location: ./login.php');
                            exit();
                        } else {
                            header('Location: ./register.php?err=password');
                            exit();
                        }
                    } else {
                        header('Location: ./register.php?err=email');
                        exit();
                    }
                } else {
                    header('Location: ./register.php?err=email_length');
                    exit();
                }
            } else {
                header('Location: ./register.php?err=already');
                exit();
            }
        }
    }

    public function typeUser($tokenUser)
    {
        $sql = $this->db->getSql();

        $requete = "SELECT typeUser FROM UTILISATEUR WHERE TOKEN_USER = :TOKEN";
        $result = $sql->prepare($requete);
        $result->execute([':TOKEN' => $tokenUser]);

        return $result->fetch(PDO::FETCH_ASSOC)['typeUser'];
    }
}
?>
