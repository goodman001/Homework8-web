ssh-keygen -t rsa -C "youremail@yourcompany.com” -f ~/.ssh/id-rsa

ssh-keygen -t rsa -C "youremail@yourcompany.com” -f ~/.ssh/id2-rsa

将pub公钥内容分别拷贝至目标账号
然后 添加私钥
ssh-add ~/.ssh/id_rsa
ssh-add ~/.ssh/id2_rsa


在 ~/.ssh 目录下新建一个config文件
touch config
添加内容：
# gitlab
Host gitlab.com
    HostName gitlab.com
    PreferredAuthentications publickey
    IdentityFile ~/.ssh/id_rsa
# github
Host second.github.com
    HostName github.com
    PreferredAuthentications publickey
    IdentityFile ~/.ssh/id2_rsa


http://shihao316558512.github.io/bootstrap/form.html
http://www.runoob.com/angularjs/angularjs-directives.html
