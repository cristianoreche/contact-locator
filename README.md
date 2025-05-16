# 📍 Contact Locator

Sistema web completo para **cadastro de contatos com geolocalização** integrado ao mapa e exportação em PDF/CSV. Projeto desenvolvido como **teste técnico FullStack** com foco em organização, usabilidade e boas práticas com Laravel e Blade puro.

---

## ⚙️ Tecnologias Utilizadas

- **Laravel 11** com autenticação via **Sanctum**
- **MariaDB** como banco de dados
- **Blade** (sem Vue ou Livewire)
- **CSS com metodologia BEM**
- **Leaflet.js** para mapa interativo
- **DomPDF** para geração de relatórios em PDF

---

## 🧱 Estrutura do Projeto

- `Controllers/Api` e `Controllers/Web`
- `Services` (ex: `MockGeocoderService`)
- `Requests` para validação de formulários
- `Repositories` para abstração do acesso a dados
- `Components Blade` reutilizáveis: todos os elementos da interface foram componentizados, incluindo botões, tabelas, formulários, inputs, alertas, modais e estrutura de layout, facilitando a manutenção e padronização visual do sistema
- `AuditLog`: sistema de **logs de auditoria completo**, com registro automático de todas as ações dos usuários autenticados, incluindo:
  - Ação (`action`)
  - Descrição detalhada
  - IP (`ip_address`)
  - Agente do navegador (`user_agent`)
  - Data e hora (`created_at`)

---

## ♻️ Componentização e Boas Práticas

O projeto foi desenvolvido com foco em **reutilização de código e arquitetura limpa**, por isso quase todos os elementos visuais foram implementados como **Componentes Blade**, seguindo o padrão BEM e com CSS modularizado.

> Isso garante:
> - Reaproveitamento fácil em diferentes views
> - Estilo visual unificado
> - Redução de duplicidade de código
> - Facilidade para evoluir o sistema com novas funcionalidades

Exemplos de componentes implementados:
- `<x-button>`, `<x-link>`, `<x-table>`, `<x-form.input>`, `<x-shared.alert>`, `<x-pagination>`, `<x-modal>` e outros

---

## 🧩 Banco de Dados

As **migrations** criam três tabelas principais:

- `users`: com verificação de e-mail e senha
- `contacts`: com campos completos de endereço, latitude e longitude
- `audit_logs`: registro de ações dos usuários autenticados

> 💡 Requer um banco **MariaDB** já configurado no `.env`.

---

## ✉️ Funcionalidades de Autenticação

- Cadastro com e-mail e verificação
- Login com token
- Recuperação de senha via e-mail
- Proteção de rotas com middleware `auth` + `verified`

---

## 🗺️ Funcionalidades do Módulo de Contatos

- CRUD completo
- Mapa lateral com todos os contatos georreferenciados
- Visualização individual no mapa
- Tooltip com informações e link direto para WhatsApp
- Filtros de busca (por nome, CPF, cidade, estado)
- Tabela responsiva com ações
- Logs de auditoria para cada ação do usuário

---

## 📝 Funcionalidades do Módulo de Logs

- Listagem de logs com paginação
- Filtro por tipo de ação e descrição
- Exibição do IP e navegador utilizado
- Exportação para **CSV** e **PDF** com filtros aplicados
- Mapeamento legível das ações (ex: `updated_contact` → "Atualizou Contato")
- Acesso protegido por autenticação

---

## 📤 Exportações

- Exportação de contatos em **CSV**
- Exportação filtrada em **PDF**
- Ambas as rotas já disponíveis no menu

---

## 🔍 Filtros e Pesquisa

- Campo de **busca global** por nome e CPF
- **Filtros por cidade e estado** diretamente na tabela
- A filtragem impacta também os resultados do mapa

---

## ✅ Testes Automatizados

Rodar os testes:

```bash
php artisan test
```

Cobertura:

- Cadastro e login (AuthTest)
- CRUD de contatos (ContactTest)
- Validação de CPF (CpfValidationTest)

---

## 🚀 Como Rodar o Projeto

```bash
git clone https://github.com/cristianoreche/contact-locator.git
cd contact-locator

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

# Configure o .env com o banco MariaDB da sua máquina
php artisan serve
```

---

## 🧪 Observações

- O projeto usa um **Mock Geocoder** para simular coordenadas a partir do CEP/endereço
- O envio de e-mail está baseado nas configurações do servidor (`MAIL_*` no `.env`)
- Todo o layout é responsivo e adaptado para celular

---

### 🗺️ Por que usamos OpenStreetMap e não Google Maps?

Optamos por utilizar **OpenStreetMap (OSM)** com a biblioteca **Leaflet.js** por ser uma solução gratuita, de código aberto e sem a necessidade de criar contas, tokens ou configurar métodos de pagamento, como ocorre com a API do Google Maps.

Além disso, o OSM atende perfeitamente às necessidades do projeto, oferecendo visualização em mapa de ruas, satélite (via Esri) e suporte completo para marcadores, tooltips e controle de camadas, sem custos.

**Vantagens:**
- ✅ Sem necessidade de cadastro em plataformas externas
- ✅ Sem chave de API
- ✅ Sem cobrança por uso
- ✅ Visual moderno e personalizável
- ✅ Rápida integração com Leaflet


## 👨‍💻 Autor

Desenvolvido por **Cristiano Reche - Especialista PHP** – com foco em organização, escalabilidade e clareza técnica para avaliação em testes de seleção.
