<?php
/**
 * 获取客户端IP地址
 * 验证获取到的客户端IP地址是IPv4还是IPv6
 * @return array
 */
function ip() {
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }
    $realIp = [];
    if ( filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
        // Yes it's valid IPv4
        $realIp['ipv4'] = $ip;
    }
    if ( filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
        // Yes it's valid IPv6
        $realIp['ipv6'] = $ip;
    }
    return $realIp;
}

$t = 4;
$ip_array = ip();
if (array_key_exists('ipv4', $ip_array)) {
	$real_ip = $ip_array['ipv4'];
}
if (array_key_exists('ipv6', $ip_array)) {
	$real_ip = $ip_array['ipv6'];
	$t = 6;
}
?><html>
<head>
  <title>Your IP(v<?php echo $t; ?>) - <?php echo phpversion(); ?></title>
</head>
<body bgcolor="#000000" text="#CC0000">
  <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
  <center><p><span style="font-weight:bold; font-size:200%"><?php echo $real_ip; ?></span></p></center>
</body>
</html>
