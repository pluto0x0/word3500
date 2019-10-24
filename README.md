# word3500
高考英语词汇3500

[![GitHub stars](https://img.shields.io/github/stars/pluto0x0/word3500)](https://github.com/pluto0x0/word3500/stargazers)
[![GitHub license](https://img.shields.io/github/license/pluto0x0/word3500)](https://github.com/pluto0x0/word3500/blob/master/LICENSE)
[![GitHub forks](https://img.shields.io/github/forks/pluto0x0/word3500)](https://github.com/pluto0x0/word3500/network)

![BOOK](https://i.loli.net/2019/10/23/ry29NoLqEHGTsSZ.png)
## Requirements
+ php
+ MySQL
## Features
+ 发音（英/美音）F
+ 标记
+ 筛选
+ 自动朗读
+ 搜索
## Usage
```shell
git clone https://github.com/pluto0x0/word3500.git
```
### Configure
**请先编辑 [config.php](https://github.com/pluto0x0/word3500/blob/master/config.php) 进行配置。**
#### Web
+ `$filename` ：单词源文件；
+ `$self` ：主页文件名；
+ `$interval` ：每一页显示的单词个数；
+ `$width` ：字体宽度；
+ `$cellpadding` ：表格单元边界与单元内容之间的间距；
+ `$font_size` ：字体大小。

#### Mysql
+ `$db_name` ：数据库名;
+ `$sql_user` ：数据库用户名;
+ `$sql_passwd` ：数据库用户密码；
+ `$word_length` ：数据表中单词字符串的长度。

**完成配置后，请访问 ```sql.php``` 进行数据库的初始化**

*注意，此操作会清空收藏信息！*

请访问 ```test.php```

## Demo
[Demo](https://pluto0x0.xyz/test/test.php)

---
*单词来源互联网*
