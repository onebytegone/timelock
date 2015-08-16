# TimeLock

This is a gatekeeper to prevent serving of files before a given date.

The code in this project has not been reviewed for stability. This was written as a fun side project. I would strongly recommend against using this in production setting.


## Setup

```
git clone https://github.com/onebytegone/timelock.git
cd timelock
cp environment.demo.php environment.php
cp timelock.demo.json timelock.json
```

## Config

### `environment.php`
This is used for the PHP environment configuration. Timezone settings for instance.

### `timelock.json`
This controls the allowed files and when they become available.
