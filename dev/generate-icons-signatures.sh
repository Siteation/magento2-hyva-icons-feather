#!/usr/bin/env bash

# Based on the Hyva version
# Only now withg a question for multiple icon support

BASE_PATH=""
# NAME=$1

# if [[ -z "$NAME" ]]; then
#   read -p "Icon folder name: " NAME
# fi

echo "getting icons from ../view/frontend/web/svg/feather"
for FILE in view/frontend/web/svg/feather/*.svg
do
    echo -n " * @method string "
    # convert file name to camelCase
    echo -n $(basename -s .svg $FILE)
    echo "Html(string \$classnames = '', ?int \$width = null, ?int \$height = null)"
done

# for FILE in src/view/frontend/web/svg/heroicons/outline/*.svg
# do
#     echo -n " * @method string "
#     echo -n $(basename -s .svg $FILE | sed -E 's/-(.)/\U\1/g')
#     echo "Html(string \$classnames = '', ?int \$width = null, ?int \$height = null)"
# done
