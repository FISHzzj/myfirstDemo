--#表名     xz_admin
--#列名     aid,aname,apwd
--#列类型
--    aid  INT PRIMARY KEY AUTO_INCREMENT
--    aname   VARCHAR(25) 字符数量（英文，数字，中文）
--    apwd    VARCHAR(32) 加密-》保存MD5()->32位字符
--
--    原文                                 密文
--    "abc"  ===>md5(md5("abc"))==>    123abc123
#进入xz库中
#创建表  xz_admin(aid,aname,apwd)
#添加数据 md5("abc")
#表名，列名，全小写
DROP database if exists xz;
create database xz;
use xz;
create table xz_admin(
        aid int(11)  primary key not null auto_increment,
        aname varchar(35) default null,
        apwd varchar(35) default null
);
insert into xz_admin values(NULL, "Tom" , md5("123asd123")),
                             (NULL, "zhuangzhuang",md5("123456")),
                             (NULL,"dongdong",md5("123123")) ;
--实际项目中有些项目特性要求
--1.所有表添加四列
--cuid ctime  {创建记录用户编号，创建时间} INSERT
--muid mtime   {修改记录用户编号，修改时间} update
--2.所有记录不允许DELETE操作
--isdel       {0 正常数据  1已经被删除}
select aid from xz_admin where aname='$aname' and apwd='$apwd' and isdel=0;
#3.为了适应项目的扩展性，习惯添加几列【备用列】
vi1 vi2 INT
vs1 vs2 VARCHAR(255)
表100行  ALTER table xz_admin add isdel int; //1s
表100w行 1h
#4：如果项目中有查询非常频繁数据，而且要求查询速度快
将数据复制一份到redis，程序查询redis  redis查询快速【2w】














