# Desarrollo web en Entorno Servidor
# Entorno de desarrollo para Laravel (sin Sail)
# Usamos PHP 8.4 CLI (Basado en Debian Linux)
FROM php:8.4-cli

# Argumentos (Usuario 'admin')
ARG USERNAME=admin
ARG USER_ID=1000
ARG GROUP_ID=1000

# -------------------------------------------------------------------------------------
ENV HOME=/home/$USERNAME
# -------------------------------------------------------------------------------------

WORKDIR /var/www/html

# 1. Instalar dependencias básicas + herramientas
RUN apt-get update && apt-get install -y \
    curl git unzip zip gnupg2 lsb-release \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev libonig-dev libxml2-dev libicu-dev \
    nano sudo \
    && rm -rf /var/lib/apt/lists/*

# 2. Instalar Node.js 20.x (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# 3. Instalar extensiones PHP necesarias para Laravel
# Laravel necesita pdo_mysql, bcmath, intl, etc.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
       pdo_mysql mbstring exif pcntl bcmath gd intl zip xml
# ---------------------------------------------------------------

# 4. Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 5. Crear tu usuario 'admin' y configurar permisos
RUN groupadd -g $GROUP_ID $USERNAME \
    && useradd -u $USER_ID -g $GROUP_ID -m -s /bin/bash $USERNAME \
    && echo "$USERNAME ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/$USERNAME \
    && chmod 0440 /etc/sudoers.d/$USERNAME

RUN chown -R $USERNAME:$USERNAME /home/$USERNAME
# --------------------------------------------------------------------

# 6. Configuración final
USER $USERNAME

# Prompt bonito
RUN echo 'export PS1="\[\e[32m\]\u@linux\[\e[m\]:\[\e[34m\]\W\[\e[m\]$ "' >> ~/.bashrc

# Exponemos los puertos
EXPOSE 8000 5173

# Mantenemos el contenedor encendido
CMD ["tail", "-f", "/dev/null"]