# 🍃 Air Quality API

<p align="center">
    <img src="./docs/cover.png" height="300" alt="Air Quality">
    <p align="center">
        <a href="https://github.com/mihaichris/air-quality-cli/actions"><img alt="GitHub Workflow Status (master)" src="https://github.com/mihaichris/air-quality-cli/actions/workflows/tests.yml/badge.svg"></a>
        <a href="https://app.codecov.io/gh/mihaichris/air-quality-cli"><img alt="Codecov" src="https://img.shields.io/codecov/c/github/mihaichris/air-quality-cli?color=%23FC0177&label=Codecov"></a>
        <a href="https://github.com/mihaichris/air-quality-cli/issues"><img alt="Open Issues" src="https://img.shields.io/github/issues/mihaichris/air-quality-cli"></a>
    </p>
</p>



# Description
 Air Quality CLI is a small CLI tool that is powered by [air-quality](https://github.com/mihaichris/air-quality) PHP package. Provide de coordinates of the location you want and retrieve the weather variables of that point location.

# 🚀 Installation
To install the CLI you can download the repository and run `air-quality` script or you can install it through [atelier](https://github.com/mihaichris/atelier) scoop bucker:

```powershell
scoop bucket add atelier https://github.com/mihaichris/atelier
```

To install, do:
```powershell
scoop install atelier/air-quality-cli
```

# Basic Usage

```powershell
# Get current air quality from Bucharest
./air-quality current latitude=44.38 longitude=26.14
```

# 👨‍💻 Author
Mihai-Cristian Făgădău
 * Github: [@mihaichris](https://github.com/mihaichris)
 * LinkedIn: [in/mihai-fagadau](https://www.linkedin.com/in/mihai-fagadau/)
 * Website: [mihaifagadau.dev](mihaifagadau.dev)

# 🤝 Contributing
Contributing details can be found at [here](./CONTRIBUTING.md).

# 📝 License
This project is [MIT](https://opensource.org/licenses/MIT) licensed.
