# Harvey Recovery Status API
A simple api to deliver personalized status reports for Hurricane Harvey recovery.

## Contributing
### Guidelines
Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/chrismichaels84/harvey-recovery-api).

### Pull Requests
- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - Check the code style with ``$ composer check-style`` and fix it with ``$ composer fix-style``.

- **Add tests!** - Your patch won't be accepted if it doesn't have tests.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.

- **Create feature branches** - Don't ask us to pull from your master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

### Running Tests

``` bash
$ composer test
```

### Setup Your Local Environment
**1. Clone this repo**
https://github.com/chrismichaels84/harvey-recovery-api.git

**2. Make sure Docker is installed**
https://www.docker.com/get-docker

**3. Copy the harvey-recovery-api docker file**
`cp laradock-env laradock/.env`

**4. Copy the framework environment file**
`cp .env.dev .env`

**5. Enter the laradock directory**
`cd laradock`

**6. Run the Docker instance**
`docker-compose up -d mysql nginx`

This may take a while the first time. It has to download several images.

**7. Enter the Docker instance**
`docker-compose exec workspace bash`

**8. Install composer**
From inside the docker instance, run `composer install`

**9. Use the API**
Go to http://localhost/ to use the api locally

**10. Do your thing :)**
Be sure to follow the contributing guidelines below.

**After the first setup, you should only have to do 5 and 6**

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Michael wilson](http://github.com/chrismichaels84)
- [Andy Davies]()www.outstandy.com)
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
