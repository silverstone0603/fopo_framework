# FOPO Framework
### based on PHP (Ver 5.4.16)
※ 1Q to 3Q University Capstone Project of 2019.

FOPO를 위한 PHP 기반의 웹 프레임워크입니다.<br><br>
기존의 MVC(Model-View-Controller) 모델을 바탕으로한 CVP(Core-View-Process) 모델을 바탕으로 설계하였으며, PC 및 모바일 환경을 분리하여 제공하도록 설계하였습니다.<br><br>

Server에 최초 설치시, 아래의 서버 권장 사양에 맞춰서 해주시면 되며,<br>
Server 환경 설정값은 system 디렉토리의 fopo_sys_config.php 파일에 추가하여 주세요.

또한 .htaccess 파일을 생성하여 다음 내용을 추가하여 주세요.

------------------------------------------------------------------------------------
### AddType image/svg+xml svg svgz<br>
### AddEncoding gzip svgz<br><br>
### RewriteEngine On<br>
### RewriteBase /<br>
### RewriteCond $1 !^(index\.php|images|captcha|data|include|uploads|js|robots\.txt)<br>
### RewriteCond %{REQUEST_FILENAME} !-f<br>
### RewriteCond %{REQUEST_FILENAME} !-d<br>
### RewriteRule ^(.*)$ /index.php/$1 [L]<br>
------------------------------------------------------------------------------------



개발 기간은 2019년 3월부터 7월까지이며, 개발에 투입된 구성원은 다음과 같습니다.<br>

------------------------------------------------------------------------------------
### Project Manager / Core Architecture Designer / User Interface and User eXperience Designer
오은석 (EunSeok Oh)

### Project Leader / Process Module Engineer
김상원 (SangWon Kim)

### Project Engineer / JavaScript & jQuery Engineer
임동균 (DongGyun Im)

### Special Thanks To
김동신 (DongShin Kim, Project Advisor Professor)

------------------------------------------------------------------------------------

개발에 사용된 기술은 다음과 같습니다.

------------------------------------------------------------------------------------
### Web Service
HTML / CSS / JavaScript / jQuery / AJAX

### Back-End & Server Configuration
Apache / MariaDB / PHP<br>
NAVER Cloud Platform (CentOS 7.2 64bit, MySQL Included)

------------------------------------------------------------------------------------

FOPO에 대한 자세한 내용은 <a href="https://github.com/silverstone0603/fopo_camera">FOPO Camera GitHub 페이지</a>를 확인해주시면 감사하겠습니다.<br>
감사합니다.
