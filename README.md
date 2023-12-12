
# ALPHA SYSTEM - API

### 🛠️ SOBRE O PROJETO

Desenvolvimento de um sistema para automatização total da folha 
de pagamento de uma empresa.



### 🏝️ STACKS UTILIZADAS

Laravel / SQL SERVER

Padrão MVC
### 💠 INSTALAÇÃO 

Passo a passo para instalar o projeto e executar.

```bash
git clone https://github.com/giovane-breno/api-payroll/
```
```bash
composer install
```
```bash
php artisan serve
```

    
## Arquivos Importantes
```
app/
┣ Http/
┃ ┣ Controllers/ - ONDE FICA TODA A LÓGICA DO SISTEMA
┃ ┃ ┣ AdminController.php
┃ ┃ ┣ AdminRoleController.php
┃ ┃ ┣ AuthController.php
┃ ┃ ┣ BenefitController.php
┃ ┃ ┣ BenefitTypeController.php
┃ ┃ ┣ CompanyController.php
┃ ┃ ┣ Controller.php
┃ ┃ ┣ DivisionController.php
┃ ┃ ┣ FinanceController.php
┃ ┃ ┣ GratificationController.php
┃ ┃ ┣ IncidentController.php
┃ ┃ ┣ LogController.php
┃ ┃ ┣ RoleController.php
┃ ┃ ┣ UserController.php
┃ ┃ ┗ VacationController.php

┃ ┣ Resources/ - DTO (DATA TRANSFER OBJECT - FORMATAR A RESPOSTA JSON)
┃ ┃ ┣ Admin/
┃ ┃ ┃ ┣ AdminCollection.php
┃ ┃ ┃ ┗ AdminResource.php

┃ ┃ ┣ AdminRole/
┃ ┃ ┃ ┣ AdminRoleCollection.php
┃ ┃ ┃ ┗ AdminRoleResource.php

┃ ┃ ┣ Benefit/
┃ ┃ ┃ ┣ BenefitCollection.php
┃ ┃ ┃ ┗ BenefitResource.php

┃ ┃ ┣ BenefitType/
┃ ┃ ┃ ┣ BenefitTypeCollection.php
┃ ┃ ┃ ┗ BenefitTypeResource.php

┃ ┃ ┣ Company/
┃ ┃ ┃ ┣ CompanyCollection.php
┃ ┃ ┃ ┗ CompanyResource.php

┃ ┃ ┣ Division/
┃ ┃ ┃ ┣ DivisionCollection.php
┃ ┃ ┃ ┗ DivisionResource.php

┃ ┃ ┣ Gratification/
┃ ┃ ┃ ┣ GratificationCollection.php
┃ ┃ ┃ ┗ GratificationResource.php

┃ ┃ ┣ Incident/
┃ ┃ ┃ ┣ IncidentCollection.php
┃ ┃ ┃ ┗ IncidentResource.php

┃ ┃ ┣ Payroll/
┃ ┃ ┃ ┣ PayrollCollection.php
┃ ┃ ┃ ┗ PayrollResource.php

┃ ┃ ┣ Role/
┃ ┃ ┃ ┣ RoleCollection.php
┃ ┃ ┃ ┗ RoleResource.php

┃ ┃ ┣ User/
┃ ┃ ┃ ┣ UserCollection.php
┃ ┃ ┃ ┗ UserResource.php

┃ ┃ ┣ Vacation/
┃ ┃ ┃ ┣ VacationCollection.php
┃ ┃ ┃ ┗ VacationResource.php
┃ ┃ ┗ PaginationResource.php

┃ ┣ Services/ - PARA DEIXAR O CODIGO LEGIVEL FOI SEPARADO EM PEQUENOS SERVIÇOS
┃ ┃ ┣ Admin/
┃ ┃ ┃ ┣ CreateAdminService.php
┃ ┃ ┃ ┣ DemoteAdminService.php
┃ ┃ ┃ ┣ FindAdminService.php
┃ ┃ ┃ ┣ ListActiveAdminsService.php
┃ ┃ ┃ ┗ PromoteAdminService.php

┃ ┃ ┣ AdminRole/
┃ ┃ ┃ ┣ CreateAdminRoleService.php
┃ ┃ ┃ ┣ DeleteAdminRoleService.php
┃ ┃ ┃ ┣ FindAdminRoleService.php
┃ ┃ ┃ ┣ ListActiveAdminRolesService.php
┃ ┃ ┃ ┗ UpdateAdminRoleService.php

┃ ┃ ┣ Auth/
┃ ┃ ┃ ┗ AuthService.php

┃ ┃ ┣ Benefit/
┃ ┃ ┃ ┣ CreateBenefitService.php
┃ ┃ ┃ ┣ DeleteBenefitService.php
┃ ┃ ┃ ┣ FindBenefitService.php
┃ ┃ ┃ ┣ ListActiveBenefitsService.php
┃ ┃ ┃ ┗ UpdateBenefitService.php

┃ ┃ ┣ BenefitType/
┃ ┃ ┃ ┣ CreateBenefitTypeService.php
┃ ┃ ┃ ┣ DeleteBenefitTypeService.php
┃ ┃ ┃ ┣ FindBenefitTypeService.php
┃ ┃ ┃ ┣ ListActiveBenefitTypesService.php
┃ ┃ ┃ ┗ UpdateBenefitTypeService.php

┃ ┃ ┣ Company/
┃ ┃ ┃ ┣ CreateCompanyService.php
┃ ┃ ┃ ┣ DeleteCompanyService.php
┃ ┃ ┃ ┣ FindCompanyService.php
┃ ┃ ┃ ┣ ListActiveCompaniesService.php
┃ ┃ ┃ ┗ UpdateCompanyService.php

┃ ┃ ┣ Division/
┃ ┃ ┃ ┣ CreateDivisionService.php
┃ ┃ ┃ ┣ DeleteDivisionService.php
┃ ┃ ┃ ┣ FindDivisionService.php
┃ ┃ ┃ ┣ ListActiveDivisionsService.php
┃ ┃ ┃ ┗ UpdateDivisionService.php

┃ ┃ ┣ Finance/
┃ ┃ ┃ ┣ DeletePayrollService.php
┃ ┃ ┃ ┣ doPaymentService.php
┃ ┃ ┃ ┣ FindPayrollService.php
┃ ┃ ┃ ┗ ListActivePayrollsService.php

┃ ┃ ┣ Gratification/
┃ ┃ ┃ ┣ CreateGratificationService.php
┃ ┃ ┃ ┣ DeleteGratificationService.php
┃ ┃ ┃ ┣ FindGratificationService.php
┃ ┃ ┃ ┣ ListActiveGratificationsService.php
┃ ┃ ┃ ┗ UpdateGratificationService.php

┃ ┃ ┣ Incident/
┃ ┃ ┃ ┣ CreateIncidentService.php
┃ ┃ ┃ ┣ DeleteIncidentService.php
┃ ┃ ┃ ┣ FindIncidentService.php
┃ ┃ ┃ ┣ ListActiveIncidentsService.php
┃ ┃ ┃ ┗ UpdateIncidentService.php

┃ ┃ ┣ Role/
┃ ┃ ┃ ┣ CreateRoleService.php
┃ ┃ ┃ ┣ DeleteRoleService.php
┃ ┃ ┃ ┣ FindRoleService.php
┃ ┃ ┃ ┣ ListActiveRolesService.php
┃ ┃ ┃ ┗ UpdateRoleService.php

┃ ┃ ┣ User/
┃ ┃ ┃ ┣ CreateUserService.php
┃ ┃ ┃ ┣ DeleteUserService.php
┃ ┃ ┃ ┣ FindUserService.php
┃ ┃ ┃ ┣ ListActiveUsersService.php
┃ ┃ ┃ ┗ UpdateUserService.php

┃ ┃ ┗ Vacation/
┃ ┃   ┣ CreateVacationService.php
┃ ┃   ┣ DeleteVacationService.php
┃ ┃   ┣ FindVacationService.php
┃ ┃   ┣ ListActiveVacationsService.php
┃ ┃   ┗ UpdateVacationService.php
┃ ┗ Kernel.php

┣ Models/ - MODELS ONDE PEGA AS TABELAS DO BANCO DE DADOS
┃ ┣ Address.php
┃ ┣ Admin.php
┃ ┣ AdminRole.php
┃ ┣ Benefit.php
┃ ┣ BenefitType.php
┃ ┣ Company.php
┃ ┣ CompanyAddress.php
┃ ┣ Division.php
┃ ┣ Gratification.php
┃ ┣ Incident.php
┃ ┣ Log.php
┃ ┣ Payroll.php
┃ ┣ Phone.php
┃ ┣ Role.php
┃ ┣ User.php
┗ ┗ Vacation.php
```
## 🔰Demonstração

Detalhes das rotas do projeto.

## Autenticação e Acesso

| ROTA  | Controller |
| ------------- | ------------- |
| POST /login  | - AuthController@login  |
 

### Rotas Protegidas (Requer autenticação)

| ROTA  | Descrição |
| ------------- | ------------- |
| GET /token  | Retorna detalhes do usuário autenticado  |
GET /l/companies | Lista de empresas
GET /l/workers | Lista de trabalhadores
GET /l/divisions | Lista de divisões
GET /l/roles | Lista de funções
GET /l/roles/a | Lista de funções de administrador
GET /l/benefits | Lista de benefícios

### Estatísticas e Dados
| ROTA  | Descrição |
| ------------- | ------------- |
GET /data/admin | Total de administradores
GET /data/user | Total de usuários
GET /data/demonstrative | Demonstrativo
GET /data/salary | Soma dos salários líquidos

### Gerenciamento de Usuários

| ROTA  | Descrição |
| ------------- | ------------- |
GET /user/a | Lista de administradores
GET /user/a/{id} | Detalhes do administrador por ID
POST /user/a | Criação de administrador
PUT /user/a/{id} | Promoção de administrador
DELETE /user/a/{id} | Remoção de privilégios de administrador
GET /user | Lista de usuários ativos
GET /user/{id} | Detalhes do usuário por ID
POST /user | Criação de usuário
PUT /user/{id} | Atualização de usuário
DELETE /user/{id} | Remoção de usuário

### Gerenciamento de Divisões

| ROTA  | Descrição |
| ------------- | ------------- |
GET /division | Lista de divisões ativas
GET /division/{id} | Detalhes da divisão por ID
POST /division | Criação de divisão
PUT /division/{id} | Atualização de divisão
DELETE /division/{id} | Remoção de divisão

### Gerenciamento de Funções
| ROTA  | Descrição |
| ------------- | ------------- |
GET /role | Lista de funções ativas
GET /role/{id} | Detalhes da função por ID
POST /role | Criação de função
PUT /role/{id} | Atualização de função
DELETE /role/{id} | Remoção de função

### Gerenciamento de Funções de Administrador
| ROTA  | Descrição |
| ------------- | ------------- |
GET /admin_role | Lista de funções de administrador ativas
GET /admin_role/{id} | Detalhes da função de administrador por ID
POST /admin_role | Criação de função de administrador
PUT /admin_role/{id} | Atualização de função de administrador
DELETE /admin_role/{id} | Remoção de função de administrador

### Gerenciamento de Empresas
| ROTA  | Descrição |
| ------------- | ------------- |
GET /company | Lista de empresas ativas
GET /company/{id} | Detalhes da empresa por ID
POST /company | Criação de empresa
PUT /company/{id} | Atualização de empresa
DELETE /company/{id} | Remoção de empresa

### Gerenciamento Financeiro
| ROTA  | Descrição |
| ------------- | ------------- |
GET /finance/payment | Lista de pagamentos
GET /finance/payment/p | Realiza pagamento
GET /finance/payment/p/{id} | Pagamento individual
GET /finance/payment/{id} | Detalhes do pagamento por ID
DELETE /finance/payment/{id} | Remoção de pagamento

### Gerenciamento de Férias
| ROTA  | Descrição |
| ------------- | ------------- |
GET /vacation | Lista de férias ativas
GET /vacation/{id} | Detalhes da férias por ID
POST /vacation | Criação de férias
PUT /vacation/{id} | Atualização de férias
DELETE /vacation/{id} | Remoção de férias

### Gerenciamento de Gratificações
| ROTA  | Descrição |
| ------------- | ------------- |
GET /gratification | Lista de gratificações ativas
GET /gratification/{id} | Detalhes da gratificação por ID
POST /gratification | Criação de gratificação
PUT /gratification/{id} | Atualização de gratificação
DELETE /gratification/{id} | Remoção de gratificação

### Gerenciamento de Incidentes
| ROTA  | Descrição |
| ------------- | ------------- |
GET /incident | Lista de incidentes ativos
GET /incident/{id} | Detalhes do incidente por ID
POST /incident | Criação de incidente
PUT /incident/{id} | Atualização de incidente
DELETE /incident/{id} | Remoção de incidente

### Gerenciamento de Benefícios
| ROTA  | Descrição |
| ------------- | ------------- |
GET /benefit/t | Lista de tipos de benefícios
GET /benefit/t/{id} | Detalhes do tipo de benefício por ID
POST /benefit/t | Criação de tipo de benefício
PUT /benefit/t/{id} | Atualização de tipo de benefício
DELETE /benefit/t/{id} | Remoção de tipo de benefício
GET /benefit | Lista de benefícios
GET /benefit/{id} | Detalhes do benefício por ID
POST /benefit | Criação de benefício
PUT /benefit/{id} | Atualização de benefício
DELETE /benefit/{id} | Remoção de benefício 

## Funcionalidades

- Criação de Usuários
- Autenticação por Bearer Token
- Gerar Demonstrativos
- Consultar Demonstrativos


