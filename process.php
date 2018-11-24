<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/24/2018
 * Time: 4:04 PM
 */
echo "<pre>";
print_r($_POST);
echo "</pre>";
require ("Products.php");
if(isset($_POST)&&!empty($_POST))
{
    if(isset($_POST['action']))
    {
        switch ($_POST['action'])
        {
            case 'add':
                $product=array();
                $product_Id=$_POST['product_id'];
                foreach ($products as $key=>$value)
                {
                    if($value['Id']==$_POST['product_id'])
                    {
                        $product=$value;
                    }

                }
                echo "<pre>";
                print_r($product);
                echo "</pre>";

                if(isset($_SESSION['cart_item'])&&!empty($_SESSION['cart_item']))
                {
                    if(isset($_SESSION['cart_item'][$product_Id])&&!empty($_SESSION['cart_item'][$product_Id]))
                    {
                        $_SESSION['cart_item'][$product_Id]['quality']+=$_POST['quality'];
                    }else{
                        $data=array();
                        $data['Id']=$product['Id'];
                        $data['Name']=$product['Name'];
                        $data['quality']=$_POST['quality'];
                        $data['price']=(int)$product['price'];
                        $data['image']=$product['image'];
                        $_SESSION['cart_item'][$product_Id]=$data;
                    }
                }else{
                    $_SESSION['cart_item']=array();
                    $data=array();
                    $data['Id']=$product['Id'];
                    $data['Name']=$product['Name'];
                    $data['quality']=$_POST['quality'];
                    $data['price']=$product['price'];
                    $data['image']=$product['image'];
                    $_SESSION['cart_item'][$product_Id]=$data;
                }
                echo "<pre>";
                echo "<br>"."session";
                print_r($_SESSION);
                echo "</pre>";
                break;
            case "delete":
                unset($_SESSION['cart_item'][$_POST['Delete_Id']]);
                break;
            default:
                break;
        }
    }
}
header("Location: http://localhost/simplecart/");
die();