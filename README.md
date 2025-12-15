Plugin Extras para GLPI
Visão Geral do Projeto
O plugin "Extras" é uma extensão para o sistema GLPI que adiciona um menu personalizado com submenu, restrito a perfis específicos de usuários.
Características Principais
Funcionalidades

Menu Personalizado

Adiciona novo menu "Extras" ao sistema GLPI
Ícone personalizado
Dois submenus configuráveis


Controle de Acesso

Restrição de acesso baseada em perfis
Lista predefinida de perfis autorizados
Validação de permissão em múltiplos níveis



Perfis de Acesso Autorizados
Os seguintes perfis têm permissão de acesso:

4, 24, 28, 30, 31, 33
34, 35, 36, 37, 38, 39
172, 176, 180

Componentes do Plugin
Setup

Definição de versão
Configuração de compatibilidade GLPI
Hook de segurança CSRF
Registro de menu personalizado

Menus

Submenu 1

Página: /plugins/extras/front/menu1.php
Título configurável


Submenu 2

Página: /plugins/extras/front/menu2.php
Título configurável



Recursos Técnicos
Segurança

Verificação de login
Validação de perfil de usuário
Bloqueio de acesso não autorizado

Interface

Ícone personalizado (cérebro)
Menu dinâmico
Tratamento de erros de permissão

Tecnologias Utilizadas

Linguagem: PHP
Framework: GLPI
Autenticação: Sessão de usuário
Controle de Acesso: Perfis

Benefícios

Extensibilidade do GLPI
Personalização de menu
Controle granular de acesso
Segurança de informações

Possíveis Melhorias

Configuração dinâmica de perfis
Personalização de ícones
Suporte a mais submenus
Interface de configuração administrativa

Considerações Finais
O plugin "Extras" oferece uma solução flexível para adicionar menus personalizados no GLPI, mantendo níveis rigorosos de segurança e controle de acesso.
