<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/1/3 0003
 * Time: 下午 11:21
 */

/*
 * 当一个二维数组中大部分元素为0,或者为同一个值的数组时,可以使用稀疏数组来保存该数组
 * 记录数组一共有几行几列,把具有不同值的元素的行列及值记录在一个小规模的数组中,从而缩小程序的规模.
 * 好处：
 * 1. 压缩存储可以节省存储空间以避免资源的不必要的浪费，在数据序列化到磁盘时，压缩存储可以提高IO效率
 * 2. 原数组中存在大量的无效数据，占据了大量的存储空间，真正有用的数据却少之又少
*/
// 代表行数，有11行
$x = 11;
// 代表列数，有11列
$y = 11;
// 初始化二维数组，默认值为0
$initArr = [];

for ($i = 0; $i < $x; $i++) {
    for ($j = 0; $j < $y; $j++) {
        $initArr[$i][$j] = 0;
    }
}

// 1:白子，2：黑子
$initArr[1][2] = 1;
$initArr[3][5] = 2;

echo "-----initArr-----start-----";
echo "<pre>";
for ($i = 0; $i < $x; $i++) {
    for ($j = 0; $j < $y; $j++) {
        echo $initArr[$i][$j] . ' ';
    }
    echo "\n";
}
echo "</pre>";
echo "-----initArr-----end-----";


// 将二维数组转化为稀疏数组
$sparseArr = [];
// 记录有多少个非0元素
$sum = 0;

for ($i = 0; $i < $x; $i++) {
    for ($j = 0; $j < $y; $j++) {
        if ($initArr[$i][$j] != 0) {
            $sum++;
            $sparseArr[$sum][0] = $i;
            $sparseArr[$sum][1] = $j;
            $sparseArr[$sum][2] = $initArr[$i][$j];
        }
    }
}
// 规定第1行第2列为 总行数
$sparseArr[0][0] = $x;
// 规定第1行第2列为 总列数
$sparseArr[0][1] = $j;
// 规定第1行第3列为 总非0元素的个数
$sparseArr[0][2] = $sum;

echo "<br><br>";
echo "-----sparseArr-----start-----";
echo "<pre>";
//打印恢复后的二维数组
for ($i = 0; $i <= $sum; $i++) {
    echo $sparseArr[$i][0] . ' ';
    echo $sparseArr[$i][1] . ' ';
    echo $sparseArr[$i][2] . ' ';
    echo "\n";
}
echo "</pre>";
echo "-----sparseArr-----end-----";

$reArr = [];
//总行数
$row = $sparseArr[0][0];
//总列数
$col = $sparseArr[0][1];
for ($i = 0; $i < $row; $i++) {
    for ($j = 0; $j < $col; $j++) {
        $reArr[$i][$j] = 0;
    }
}
// 从稀疏数组的第2行开始取值，因为第1行是规定的，不用取值
for ($i = 1; $i <= $sparseArr[0][2]; $i++) {
    $reArr[$sparseArr[$i][0]][$sparseArr[$i][1]] = $sparseArr[$i][2];
}

echo "<br><br>";
echo "-----reArr-----start-----";
echo "<pre>";
//打印恢复后的二维数组
for ($i = 0; $i < $x; $i++) {
    for ($j = 0; $j < $y; $j++) {
        echo $reArr[$i][$j] . ' ';
    }
    echo "\n";
}
echo "</pre>";
echo "-----reArr-----end-----";