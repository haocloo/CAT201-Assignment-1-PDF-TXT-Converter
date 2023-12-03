## ASSIGNMENT I : Integrated Software Development Workshop 2023/2024

<br><br>
| Group 01 Members                                                     | Matric No | Role        |
| :-:                                                                  | :-:       | :-:         | 
| Yeo Din Song       [@Yeo8023](https://github.com/Yeo8023)            | 163369    | Leader      |
| Loo Chi Hao          [@haocloo](https://github.com/haocloo)          | 163703    | Member      |
| Lim Yong Jun         [@LimmmYongJun](https://github.com/LimmmYongJun)| 164598    | Member      |
| Lim Jia Liang [@LIMJIALIANG](https://github.com/LIMJIALIANG)         | 163564    | Member      |

<br>

<br>

### First time setup
```bash
git clone https://github.com/haocloo/CAT201-Assignment-1.git
cd CAT201-Assignment-1
```

### Start docker container
(Make sure you are at the root directory)
```bash
docker-compose build
docker-compose up -d
```
View website at http://localhost:8082/html/index.html

### Restart docker container
(Make sure you are at the root directory)
```bash
docker-compose down
docker-compose build
docker-compose up -d
```

### Testing your java file locally (Run this command in vscode terminal)
```bash
javac -cp ".;java/lib/*" java/*.java
```

### Create your branch (naming example : lch/module-name)
```bash
git switch dev
git switch -c <your-branch-name>
```

### Commit your changes
```bash
git add .
git commit -m "your commit message"
```

### Merge dev branch to your branch and update your branch
```bash
git pull origin dev
git push origin <your-branch-name>
```

### Merge any merge conflicts (if any)
```bash
git commit -m "Resolve merge conflict"
```

### Merge your branch to dev branch and update dev branch
```bash
git switch dev
git merge <your-branch-name>
git push origin dev
```
