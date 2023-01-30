<div style="display:flex; align-items: center">
  <h1 style="position:relative; top: -6px" >Movie Epic Quotes
</h1>
</div>

---

Movie Epic Quotes is app where users can share quotes from their favorite movies and view other users quotes, comment on them and give them like if they find quote likable.

#

### Table of Contents

-   [Prerequisites](#prerequisites)
-   [Tech Stack](#tech-stack)
-   [Getting Started](#getting-started)
-   [Migrations](#migration)
-   [Development](#development)
-   [Project Structure](#project-structure)
-   [Structure of mysql](#structure-of-mysql)

#

### Prerequisites

-   <img src="readme/assets/php.svg" width="35" style="position: relative; top: 4px" /> *PHP@8.02 and up*
-   <img src="readme/assets/mysql.png" width="35" style="position: relative; top: 4px" /> _MYSQL@8 and up_
-   <img src="readme/assets/npm.png" width="35" style="position: relative; top: 4px" /> _npm@6 and up_
-   <img src="readme/assets/composer.png" width="35" style="position: relative; top: 6px" /> _composer@2 and up_

#

### Tech Stack

-   <img src="readme/assets/laravel.png" height="18" style="position: relative; top: 4px" /> [Laravel@9.x](https://laravel.com/docs/9.x) - back-end framework
-   <img src="readme/assets/spatie.png" height="18" style="position: relative; top: 4px" /> [Spatie Translatable](https://github.com/spatie/laravel-translatable) - package for translation
-   <img src="readme/assets/vite.png" height="18" style="position: relative; top: 4px; width: 18px" /> [Vite](https://vitejs.dev/guide/) - rapid development tool

#

### Getting Started

1\. First of all you need to clone Movie Epic Quotes
from github:

```sh
git clone git@github.com:RedberryInternship/tsukho-epic-movie-quotes-back.git
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

3\. after you have installed all the PHP dependencies, it's time to install all the JS dependencies:

```sh
npm install
```

and also:

```sh
npm run dev
```

in order to build your JS/SaaS resources.

4\. Now we need to set our env file. Go to the root of your project and execute this command.

```sh
cp .env.example .env
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

#

after setting up **.env** file, execute:

```sh
php artisan config:cache
```

in order to cache environment variables.

5\. Now execute in the root of you project following:

```sh
  php artisan key:generate
```

Which generates auth key.

6\. If you've completed everything so far, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```

##### Now, you should be good to go!

#

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```

if you wish to see changes after changing styles with Tailwind CSS, execute:

```sh
  npm run dev
```

#

### Project Structure

```bash
├─── app
│   ├─── Console
│   ├─── Exceptions
│   ├─── Models
│   ├─── Http
│   ├─── Providers
├─── bootstrap
├─── config
├─── database
├─── packages
├─── public
├─── resources
├─── routes
├─── scripts
├─── storage
├─── tests
- .env
- artisan
- composer.json
- package.json
```

Project structure is fairly straitforward(at least for laravel developers)...

For more information about project standards, take a look at these docs:

-   [Laravel](https://laravel.com/docs/9.x)

#

### Structure of mysql

<img src="readme/assets/Drawsql.png" height="250" style="position: relative; top: 4px" />

</br>

[Drawsql link](https://drawsql.app/teams/giorgis-team/diagrams/epic-movie-quotes) - DrawSQL software to create, visualize and collaborate on database entity relationship diagrams.

#

### Resources from the assignment

[Figma design link](https://www.figma.com/file/O9A950iYrHgZHtBuCtNSY8/Coronatime?node-id=31%3A47&t=91Rdv9EfpdHTlQKx-0) - Figma is a collaborative web application for interface design, with additional offline features enabled by desktop applications for macOS and Windows.

[Article regarding git commits](https://redberry.gitbook.io/resources/other/git-is-semantikuri-komitebi) - Git commits were done following information provided in this article, where it is described what should be specific commit be named.

[Assignment gitbook](https://redberry.gitbook.io/coronatime/) - This assignment was done following requirements of provided in the assignment description, where it is clearly show what each section must do and what characteristics they must have.
