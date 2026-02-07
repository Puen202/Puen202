# Infra CRM ITV — Laravel 12 (PHP 8.3, MySQL/MariaDB)

Implementación completa de base para una app tipo **CRM de infraestructura** escalable por departamentos y preparada para múltiples estaciones (multi-site).

## Incluye

- Laravel 12 + Breeze (auth real) + Spatie Permission + Activitylog.
- Entidades: `sites`, `zones`, `machines`, `maps`, `map_items`, `ip_ranges`.
- Site inicial: **ITV Principal**.
- Zonas seed iniciales: SRV, OFI, NAV, LINEA1, LINEA2, LINEA3, LINEA4A, LINEA4B, CAB, WIFI, LAN.
- CRUD de máquinas con filtros y búsqueda por IP/nombre/hostname/MAC.
- Regla de negocio `cannot_move`: bloquea cambios de IP salvo `admin`.
- Mapa por zona con drag&drop (InteractJS) y persistencia de posiciones.
- Importación CSV (`IP`, `HostDNS`, `MAC`) con upsert.
- Exportación CSV de inventario.
- Planificador IP básico con rangos y huecos reservados (`reserved_gaps` JSON).
- Auditoría de cambios en máquinas con activitylog.

## Instalación en servidor

```bash
chmod +x install_laravel_app.sh
./install_laravel_app.sh mi-app-itv
cd mi-app-itv
cp .env.example .env
php artisan key:generate
# configurar DB_*
php artisan migrate --seed
```

Si no compiló frontend automáticamente:

```bash
npm install
npm run build
```

## Permisos y roles

- Roles: `admin`, `calidad`, `visor`
- Permisos: `machines.*`, `map.*`, `imports.run`, `ranges.manage`, `audit.view`

Usuario admin seed configurable por `.env`:

- `SEED_ADMIN_EMAIL`
- `SEED_ADMIN_PASSWORD`

## Despliegue Plesk/Nginx

- Document root a `public/`.
- Activar HTTPS.
- `storage:link` y permisos de escritura en `storage/` y `bootstrap/cache/`.
- Ejecutar `php artisan config:cache && php artisan route:cache` en producción.

## Preguntas pendientes (parametrizable antes de cierre final)

1. ¿Rangos IP definitivos por tipo?
2. ¿Nombres finales de zonas (confirmar LINEA4A/LINEA4B)?
3. ¿Listado completo de equipos “NO mover” y motivo?
4. ¿Formato/dimensiones finales de los planos?
5. ¿Solo una ITV por ahora o activar multi-instalación en operación?
