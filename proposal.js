const {
  Document, Packer, Paragraph, TextRun, Table, TableRow, TableCell,
  Header, Footer, AlignmentType, HeadingLevel, BorderStyle, WidthType,
  ShadingType, VerticalAlign, PageNumber, PageBreak, LevelFormat,
  TabStopType, TabStopPosition, UnderlineType
} = require('docx');
const fs = require('fs');

// ─── COLOR PALETTE ───────────────────────────────────────────────────────────
const C = {
  primary:    "1B4F72",   // deep navy
  secondary:  "2E86C1",   // TRA blue
  accent:     "1ABC9C",   // teal
  gold:       "F39C12",   // amber
  lightBlue:  "D6EAF8",   // table header bg
  pale:       "EBF5FB",   // alternating row
  white:      "FFFFFF",
  dark:       "1C2833",
  gray:       "7F8C8D",
  lightGray:  "F2F3F4",
  border:     "AED6F1",
};

// ─── BORDER HELPERS ──────────────────────────────────────────────────────────
const nb  = { style: BorderStyle.NONE, size: 0, color: "FFFFFF" };
const tb  = { style: BorderStyle.SINGLE, size: 4, color: C.border };
const hb  = { style: BorderStyle.SINGLE, size: 8, color: C.secondary };
const noBorders  = { top: nb, bottom: nb, left: nb, right: nb, insideH: nb, insideV: nb };
const thinBorders = { top: tb, bottom: tb, left: tb, right: tb };
const headerBorders = { top: hb, bottom: hb, left: hb, right: hb };

// ─── REUSABLE PARAGRAPH FACTORIES ────────────────────────────────────────────
const spacer = (pt = 6) => new Paragraph({
  children: [new TextRun("")],
  spacing: { before: pt * 20, after: pt * 20 }
});

const heading1 = (text, color = C.primary) => new Paragraph({
  heading: HeadingLevel.HEADING_1,
  children: [new TextRun({ text, color, bold: true, font: "Arial", size: 36 })],
  spacing: { before: 360, after: 160 },
  border: { bottom: { style: BorderStyle.SINGLE, size: 6, color: C.accent, space: 4 } }
});

const heading2 = (text) => new Paragraph({
  heading: HeadingLevel.HEADING_2,
  children: [new TextRun({ text, color: C.secondary, bold: true, font: "Arial", size: 28 })],
  spacing: { before: 280, after: 120 }
});

const heading3 = (text) => new Paragraph({
  children: [new TextRun({ text, color: C.primary, bold: true, font: "Arial", size: 24 })],
  spacing: { before: 200, after: 80 }
});

const body = (text, opts = {}) => new Paragraph({
  children: [new TextRun({ text, font: "Arial", size: 22, color: C.dark, ...opts })],
  spacing: { before: 60, after: 80 },
  alignment: opts.center ? AlignmentType.CENTER : AlignmentType.JUSTIFIED
});

const bullet = (text, level = 0) => new Paragraph({
  numbering: { reference: "bullets", level },
  children: [new TextRun({ text, font: "Arial", size: 22, color: C.dark })],
  spacing: { before: 40, after: 60 }
});

const numbered = (text, level = 0) => new Paragraph({
  numbering: { reference: "numbers", level },
  children: [new TextRun({ text, font: "Arial", size: 22, color: C.dark })],
  spacing: { before: 40, after: 60 }
});

// ─── CELL FACTORIES ──────────────────────────────────────────────────────────
function headerCell(text, width, span = 1) {
  return new TableCell({
    columnSpan: span,
    borders: headerBorders,
    width: { size: width, type: WidthType.DXA },
    shading: { fill: C.secondary, type: ShadingType.CLEAR },
    margins: { top: 100, bottom: 100, left: 140, right: 140 },
    verticalAlign: VerticalAlign.CENTER,
    children: [new Paragraph({
      alignment: AlignmentType.CENTER,
      children: [new TextRun({ text, bold: true, color: C.white, font: "Arial", size: 22 })]
    })]
  });
}

function dataCell(text, width, shade = false, bold = false, align = AlignmentType.LEFT) {
  return new TableCell({
    borders: thinBorders,
    width: { size: width, type: WidthType.DXA },
    shading: { fill: shade ? C.pale : C.white, type: ShadingType.CLEAR },
    margins: { top: 80, bottom: 80, left: 130, right: 130 },
    verticalAlign: VerticalAlign.CENTER,
    children: [new Paragraph({
      alignment: align,
      children: [new TextRun({ text, font: "Arial", size: 22, color: C.dark, bold })]
    })]
  });
}

function accentCell(text, width) {
  return new TableCell({
    borders: thinBorders,
    width: { size: width, type: WidthType.DXA },
    shading: { fill: C.lightBlue, type: ShadingType.CLEAR },
    margins: { top: 80, bottom: 80, left: 130, right: 130 },
    verticalAlign: VerticalAlign.CENTER,
    children: [new Paragraph({
      children: [new TextRun({ text, font: "Arial", size: 22, color: C.primary, bold: true })]
    })]
  });
}

// ─── COVER PAGE ──────────────────────────────────────────────────────────────
function buildCoverPage() {
  return [
    spacer(40),
    new Paragraph({
      alignment: AlignmentType.CENTER,
      children: [new TextRun({ text: "TANZANIA REVENUE AUTHORITY", font: "Arial", size: 52, bold: true, color: C.primary })]
    }),
    new Paragraph({
      alignment: AlignmentType.CENTER,
      spacing: { before: 80, after: 80 },
      border: { bottom: { style: BorderStyle.SINGLE, size: 10, color: C.accent, space: 6 } },
      children: [new TextRun({ text: "Innovation & Technology Division", font: "Arial", size: 26, color: C.secondary, italics: true })]
    }),
    spacer(24),
    new Paragraph({
      alignment: AlignmentType.CENTER,
      children: [new TextRun({ text: "INNOVATION PROJECT PROPOSAL", font: "Arial", size: 32, bold: true, color: C.secondary })]
    }),
    spacer(12),
    // Title box
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [9360],
      rows: [
        new TableRow({
          children: [
            new TableCell({
              borders: noBorders,
              width: { size: 9360, type: WidthType.DXA },
              shading: { fill: C.primary, type: ShadingType.CLEAR },
              margins: { top: 320, bottom: 320, left: 400, right: 400 },
              children: [
                new Paragraph({
                  alignment: AlignmentType.CENTER,
                  children: [new TextRun({ text: "TRA SmartAssist AI", font: "Arial", size: 64, bold: true, color: C.white })]
                }),
                new Paragraph({
                  alignment: AlignmentType.CENTER,
                  children: [new TextRun({ text: "Smart AI Tax Assistant Platform", font: "Arial", size: 32, color: C.accent, italics: true })]
                }),
              ]
            })
          ]
        })
      ]
    }),
    spacer(24),

    // Info table
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [3200, 6160],
      rows: [
        new TableRow({ children: [accentCell("Innovation Type", 3200), dataCell("New Innovation — Never Implemented in TRA", 6160, false, true)] }),
        new TableRow({ children: [accentCell("Project Category", 3200), dataCell("AI-Powered Digital Tax Services", 6160, true)] }),
        new TableRow({ children: [accentCell("Implementation Period", 3200), dataCell("8 Months (Phased Rollout)", 6160, false)] }),
        new TableRow({ children: [accentCell("Estimated Budget", 3200), dataCell("TZS 50,000,000 – 75,000,000", 6160, true)] }),
        new TableRow({ children: [accentCell("Date Prepared", 3200), dataCell("May 2026", 6160, false)] }),
        new TableRow({ children: [accentCell("Division", 3200), dataCell("ICT & Innovation — Tanzania Revenue Authority", 6160, true)] }),
      ]
    }),
    spacer(24),
    new Paragraph({
      alignment: AlignmentType.CENTER,
      border: { top: { style: BorderStyle.SINGLE, size: 4, color: C.accent, space: 6 } },
      spacing: { before: 120, after: 60 },
      children: [new TextRun({ text: "CONFIDENTIAL — FOR OFFICIAL USE ONLY", font: "Arial", size: 20, color: C.gray, bold: true })]
    }),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: EXECUTIVE SUMMARY ──────────────────────────────────────────────
function buildExecutiveSummary() {
  return [
    heading1("EXECUTIVE SUMMARY"),
    body("TRA SmartAssist AI is a proposed AI-powered taxpayer assistance platform designed to fundamentally transform how the Tanzania Revenue Authority (TRA) delivers services to millions of taxpayers across the country. This innovation addresses longstanding challenges around taxpayer confusion, language barriers, low digital literacy, and overburdened customer support channels."),
    spacer(4),
    body("The platform introduces six integrated capabilities: a bilingual AI Tax Assistant (Swahili + English), a unique Confusion Detection & Screenshot Analysis System, an AI-powered Voice Assistant for mobile-first and low-literacy users, a Smart TIN Registration Helper, AI Document Verification, and a Taxpayer Education Center — all united into a single, secure, and scalable platform."),
    spacer(4),
    body("By automating routine taxpayer support and providing intelligent, context-aware guidance, TRA SmartAssist AI is expected to: reduce support queue wait times, lower administrative costs, improve filing accuracy, expand the tax base to informal sector participants, and position TRA as a regional leader in digital tax administration."),
    spacer(4),

    // Key metrics table
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [2340, 2340, 2340, 2340],
      rows: [
        new TableRow({ children: [
          headerCell("Estimated Users", 2340),
          headerCell("Languages", 2340),
          headerCell("Modules", 2340),
          headerCell("Timeline", 2340),
        ]}),
        new TableRow({ children: [
          dataCell("500,000+", 2340, false, true, AlignmentType.CENTER),
          dataCell("Swahili & English", 2340, true, false, AlignmentType.CENTER),
          dataCell("6 Integrated", 2340, false, true, AlignmentType.CENTER),
          dataCell("8 Months (3 Phases)", 2340, true, false, AlignmentType.CENTER),
        ]}),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: INNOVATION DESCRIPTION ─────────────────────────────────────────
function buildInnovationDescription() {
  return [
    heading1("1. INNOVATION IDEA OVERVIEW"),
    heading2("1.1 What is TRA SmartAssist AI?"),
    body("TRA SmartAssist AI is an intelligent taxpayer support platform integrated directly into TRA's existing digital infrastructure. It provides real-time, AI-driven assistance to taxpayers navigating tax registration, filing, payment, and compliance processes — available 24/7, in both Swahili and English, via chat and voice."),
    spacer(4),
    body("Unlike a simple FAQ chatbot, TRA SmartAssist AI is a multi-modal assistance ecosystem. It sees what the user sees (via screenshot upload), speaks their language (Swahili or English), and guides them step-by-step through every process — from TIN registration to VAT filing."),

    spacer(6),
    heading2("1.2 Core Innovation — Confusion Detection System"),
    body("The most distinctive feature is the \"Report Confusion\" tool. When a taxpayer gets stuck anywhere on the TRA portal, they can click the floating \"I Need Help\" button and choose to:"),
    bullet("Upload a screenshot of their screen"),
    bullet("Record their screen to show the issue in real-time"),
    bullet("Speak their problem using voice input"),
    bullet("Chat with the AI assistant"),
    spacer(4),
    body("The AI then analyzes the screenshot using computer vision and OCR technology, detects the exact problem (missing fields, wrong formats, expired documents, navigation errors), and provides clear, step-by-step guidance in the user's preferred language."),
    spacer(4),
    body("Example AI Response after screenshot analysis:"),
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [9360],
      rows: [
        new TableRow({ children: [
          new TableCell({
            borders: { top: { style: BorderStyle.SINGLE, size: 6, color: C.accent }, bottom: { style: BorderStyle.SINGLE, size: 6, color: C.accent }, left: { style: BorderStyle.SINGLE, size: 6, color: C.accent }, right: { style: BorderStyle.SINGLE, size: 6, color: C.accent } },
            width: { size: 9360, type: WidthType.DXA },
            shading: { fill: "F0FFF4", type: ShadingType.CLEAR },
            margins: { top: 120, bottom: 120, left: 200, right: 200 },
            children: [
              new Paragraph({ children: [new TextRun({ text: "AI SmartAssist Response:", font: "Arial", size: 20, bold: true, color: C.accent })] }),
              new Paragraph({ spacing: { before: 60 }, children: [new TextRun({ text: "\"I can see you are on the TIN Registration page. The form shows an error because the business license document you uploaded is blurry. Please take a clearer photo and re-upload it in JPEG or PDF format. The upload button is located below the 'Supporting Documents' section — it's the blue button labeled 'Browse Files.'\"", font: "Arial", size: 21, color: C.dark, italics: true })] }),
            ]
          })
        ]])
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: EXISTING PRACTICES ─────────────────────────────────────────────
function buildExistingPractices() {
  return [
    heading1("2. EXISTING PRACTICES & THE PROBLEM"),
    heading2("2.1 Current State of Taxpayer Support at TRA"),
    body("Currently, taxpayers rely on a combination of manual portal navigation, physical office visits, telephone customer care, and static online guides to access TRA services. While TRA has invested significantly in digital systems for TIN registration, tax filing, and payment processing, the human support layer has not kept pace with the growth in digital users."),
    spacer(4),

    // Problems table
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [3500, 5860],
      rows: [
        new TableRow({ children: [headerCell("Challenge Area", 3500), headerCell("Current Impact", 5860)] }),
        new TableRow({ children: [dataCell("Language Barriers", 3500, false, true), dataCell("Most TRA portals default to English, alienating Swahili-primary users", 5860)] }),
        new TableRow({ children: [dataCell("Low Digital Literacy", 3500, true, true), dataCell("Many small business owners and informal traders cannot navigate digital forms without assistance", 5860, true)] }),
        new TableRow({ children: [dataCell("Long Support Queues", 3500, false, true), dataCell("TRA customer care receives thousands of calls monthly for issues that AI could resolve instantly", 5860)] }),
        new TableRow({ children: [dataCell("Incomplete Applications", 3500, true, true), dataCell("Taxpayers abandon TIN and VAT registrations mid-process due to confusion about required documents", 5860, true)] }),
        new TableRow({ children: [dataCell("Document Errors", 3500, false, true), dataCell("Blurry uploads, wrong formats, and mismatched information cause repeated rejection cycles", 5860)] }),
        new TableRow({ children: [dataCell("Limited 24/7 Support", 3500, true, true), dataCell("Office hours restrict access; taxpayers cannot get help outside business hours", 5860, true)] }),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: IMPACT AREAS ───────────────────────────────────────────────────
function buildImpactAreas() {
  return [
    heading1("3. AREAS OF IMPACT"),
    body("TRA SmartAssist AI addresses multiple strategic priorities simultaneously, making it a high-leverage innovation. Below are the specific impact areas and how the platform delivers measurable improvements in each:"),
    spacer(6),

    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [280, 2900, 6180],
      rows: [
        new TableRow({ children: [headerCell("#", 280), headerCell("Impact Area", 2900), headerCell("How TRA SmartAssist AI Creates Impact", 6180)] }),
        new TableRow({ children: [
          dataCell("1", 280, false, true, AlignmentType.CENTER),
          dataCell("Improved Service Delivery", 2900, false, true),
          dataCell("24/7 AI support in Swahili and English eliminates wait times and provides instant, accurate guidance for all taxpayer interactions.", 6180),
        ]}),
        new TableRow({ children: [
          dataCell("2", 280, true, true, AlignmentType.CENTER),
          dataCell("Revenue Collection", 2900, true, true),
          dataCell("By simplifying filing processes and reducing errors, more taxpayers complete submissions correctly and on time — directly increasing collections.", 6180, true),
        ]}),
        new TableRow({ children: [
          dataCell("3", 280, false, true, AlignmentType.CENTER),
          dataCell("TRA Systems Modernization", 2900, false, true),
          dataCell("Integration of AI, OCR, speech recognition, and computer vision aligns TRA with leading global tax administration technology standards.", 6180),
        ]}),
        new TableRow({ children: [
          dataCell("4", 280, true, true, AlignmentType.CENTER),
          dataCell("Expand Tax Base", 2900, true, true),
          dataCell("Voice support and simplified Swahili interfaces make TRA services accessible to informal sector traders and rural taxpayers for the first time.", 6180, true),
        ]}),
        new TableRow({ children: [
          dataCell("5", 280, false, true, AlignmentType.CENTER),
          dataCell("Minimize Collection Costs", 2900, false, true),
          dataCell("AI handles thousands of routine support interactions per day, dramatically reducing the need for human customer service staff resources.", 6180),
        ]}),
        new TableRow({ children: [
          dataCell("6", 280, true, true, AlignmentType.CENTER),
          dataCell("Administration Cost Reduction", 2900, true, true),
          dataCell("Automated document verification, smart error detection, and self-service registration reduce operational overhead across TRA departments.", 6180, true),
        ]}),
        new TableRow({ children: [
          dataCell("7", 280, false, true, AlignmentType.CENTER),
          dataCell("Governance & Risk Management", 2900, false, true),
          dataCell("AI-powered audit trails, document validation, and interaction monitoring strengthen compliance oversight and reduce fraud risk.", 6180),
        ]}),
        new TableRow({ children: [
          dataCell("8", 280, true, true, AlignmentType.CENTER),
          dataCell("Leading Technology Adoption", 2900, true, true),
          dataCell("Positions TRA as an innovation leader in East African tax administration, attracting investor confidence and international recognition.", 6180, true),
        ]}),
        new TableRow({ children: [
          dataCell("9", 280, false, true, AlignmentType.CENTER),
          dataCell("Employee Performance", 2900, false, true),
          dataCell("TRA officers are freed from repetitive queries and can focus on complex cases, investigations, and value-added taxpayer relationship management.", 6180),
        ]}),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: SYSTEM MODULES ─────────────────────────────────────────────────
function buildSystemModules() {
  return [
    heading1("4. PLATFORM MODULES & FEATURES"),
    body("The TRA SmartAssist AI platform is composed of six deeply integrated modules. Together, they form a comprehensive Intelligent Taxpayer Assistance Ecosystem — far beyond a simple chatbot."),
    spacer(6),

    heading2("Module 1: AI Tax Assistant (Core Engine)"),
    body("The central intelligence of the platform. Taxpayers can ask any tax-related question and receive instant, accurate answers with step-by-step guidance."),
    bullet("Covers PAYE, VAT, SDL, TIN, penalties, deadlines, filing procedures, and appeals"),
    bullet("Context-aware responses based on taxpayer profile and history"),
    bullet("Escalates complex issues to human TRA officers with full conversation context"),
    bullet("Available 24/7, 365 days per year"),
    spacer(4),

    heading2("Module 2: Multilingual Support (Swahili + English)"),
    body("Language should never be a barrier to tax compliance. This module ensures full platform accessibility in Tanzania's two primary languages."),
    bullet("Real-time Swahili ↔ English translation for all interactions"),
    bullet("Culturally appropriate phrasing and examples"),
    bullet("Auto-detection of user's preferred language from first message"),
    bullet("Voice input and output in both languages"),
    spacer(4),

    heading2("Module 3: Confusion Detection & Screenshot Analyzer"),
    body("The platform's most distinctive innovation. Uses computer vision and OCR to analyze user screenshots and provide targeted, precise guidance."),
    bullet("Users upload screenshots of confusing portal pages"),
    bullet("AI detects: missing fields, wrong file formats, incomplete applications, expired documents, navigation errors"),
    bullet("Provides annotated guidance pointing to exact screen locations"),
    bullet("Screen recording option for complex multi-step issues"),
    spacer(4),

    heading2("Module 4: Smart TIN Registration Helper"),
    body("Guides taxpayers through the entire TIN registration process with intelligent form assistance."),
    bullet("Step-by-step guidance for individual, business, and NGO TIN applications"),
    bullet("Real-time field validation with clear error explanations"),
    bullet("Document checklist with format requirements before upload"),
    bullet("Progress saving so users can continue incomplete applications later"),
    spacer(4),

    heading2("Module 5: AI Document Verification"),
    body("Reduces the most common cause of application rejection: document quality and completeness issues."),
    bullet("Detects blurry, low-resolution, or corrupt uploads before submission"),
    bullet("Verifies name consistency across multiple submitted documents"),
    bullet("Checks for required signatures, stamps, and dates"),
    bullet("Supports ID cards, business licenses, passports, financial statements, and TRA forms"),
    spacer(4),

    heading2("Module 6: Voice Assistant"),
    body("Designed specifically for mobile-first users, the elderly, and taxpayers with low typing literacy."),
    bullet("Full speech-to-text capability in Swahili and English"),
    bullet("Text-to-speech responses for hands-free interaction"),
    bullet("Optimized for 2G/3G connections for rural users"),
    bullet("Compatible with basic Android smartphones — no app installation required"),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: IMPLEMENTATION PLAN ────────────────────────────────────────────
function buildImplementationPlan() {
  return [
    heading1("5. PHASED IMPLEMENTATION PLAN"),
    body("The 8-month implementation follows three progressive phases, each building on the last. This approach minimizes risk, allows for user feedback integration, and ensures stable deployment before advancing to more complex features."),
    spacer(6),

    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [1560, 2000, 3600, 2200],
      rows: [
        new TableRow({ children: [headerCell("Phase", 1560), headerCell("Duration", 2000), headerCell("Deliverables", 3600), headerCell("Milestone", 2200)] }),
        new TableRow({ children: [
          new TableCell({
            rowSpan: 1,
            borders: thinBorders,
            width: { size: 1560, type: WidthType.DXA },
            shading: { fill: C.lightBlue, type: ShadingType.CLEAR },
            margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "Phase 1\nMVP", font: "Arial", size: 22, bold: true, color: C.primary })] })]
          }),
          dataCell("Months 1–3", 2000, false, false),
          new TableCell({
            borders: thinBorders,
            width: { size: 3600, type: WidthType.DXA },
            shading: { fill: C.white, type: ShadingType.CLEAR },
            margins: { top: 80, bottom: 80, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets", level: 0 }, children: [new TextRun({ text: "AI Chatbot (Swahili + English)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets", level: 0 }, children: [new TextRun({ text: "Taxpayer Education Center", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets", level: 0 }, children: [new TextRun({ text: "Smart TIN Registration Helper", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets", level: 0 }, children: [new TextRun({ text: "Personal Tax Dashboard", font: "Arial", size: 20 })] }),
            ]
          }),
          dataCell("Live AI chatbot accessible to all TRA portal users", 2200, false),
        ]}),
        new TableRow({ children: [
          new TableCell({
            borders: thinBorders,
            width: { size: 1560, type: WidthType.DXA },
            shading: { fill: "FEF9E7", type: ShadingType.CLEAR },
            margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "Phase 2\nAdvanced", font: "Arial", size: 22, bold: true, color: C.gold })] })]
          }),
          dataCell("Months 4–6", 2000, true, false),
          new TableCell({
            borders: thinBorders,
            width: { size: 3600, type: WidthType.DXA },
            shading: { fill: C.pale, type: ShadingType.CLEAR },
            margins: { top: 80, bottom: 80, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets2", level: 0 }, children: [new TextRun({ text: "Screenshot Confusion Analyzer", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets2", level: 0 }, children: [new TextRun({ text: "AI Document Verification (OCR)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets2", level: 0 }, children: [new TextRun({ text: "Voice Assistant (Swahili + English)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets2", level: 0 }, children: [new TextRun({ text: "Human Escalation System", font: "Arial", size: 20 })] }),
            ]
          }),
          dataCell("Full multi-modal support; screenshot analysis and voice live", 2200, true),
        ]}),
        new TableRow({ children: [
          new TableCell({
            borders: thinBorders,
            width: { size: 1560, type: WidthType.DXA },
            shading: { fill: "EAFAF1", type: ShadingType.CLEAR },
            margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "Phase 3\nIntegration", font: "Arial", size: 22, bold: true, color: C.accent })] })]
          }),
          dataCell("Months 7–8", 2000, false, false),
          new TableCell({
            borders: thinBorders,
            width: { size: 3600, type: WidthType.DXA },
            shading: { fill: C.white, type: ShadingType.CLEAR },
            margins: { top: 80, bottom: 80, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets3", level: 0 }, children: [new TextRun({ text: "Deep TRA systems integration (ITAX, ITAS)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets3", level: 0 }, children: [new TextRun({ text: "Analytics & Reporting Dashboard", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets3", level: 0 }, children: [new TextRun({ text: "Predictive Support & Smart Reminders", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets3", level: 0 }, children: [new TextRun({ text: "AI Fraud & Anomaly Detection", font: "Arial", size: 20 })] }),
            ]
          }),
          dataCell("Full platform operational; analytics and fraud detection active", 2200, false),
        ]}),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: TECHNOLOGY STACK ────────────────────────────────────────────────
function buildTechStack() {
  return [
    heading1("6. TECHNOLOGY STACK"),
    body("The platform is built on proven, enterprise-grade technologies with strong open-source support, ensuring long-term maintainability and cost efficiency."),
    spacer(6),

    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [2200, 3200, 3960],
      rows: [
        new TableRow({ children: [headerCell("Layer", 2200), headerCell("Technologies", 3200), headerCell("Purpose", 3960)] }),
        new TableRow({ children: [dataCell("Frontend (Web)", 2200, false, true), dataCell("React.js, Next.js, Tailwind CSS", 3200), dataCell("Fast, responsive taxpayer portal interface", 3960)] }),
        new TableRow({ children: [dataCell("Mobile App", 2200, true, true), dataCell("Flutter (Android + iOS)", 3200, true), dataCell("Cross-platform mobile app for voice and chat", 3960, true)] }),
        new TableRow({ children: [dataCell("Backend API", 2200, false, true), dataCell("Django (Python) / Node.js", 3200), dataCell("Core business logic, API routing, TRA integrations", 3960)] }),
        new TableRow({ children: [dataCell("AI & NLP", 2200, true, true), dataCell("OpenAI API / Google Gemini", 3200, true), dataCell("Natural language understanding, multilingual responses", 3960, true)] }),
        new TableRow({ children: [dataCell("OCR & Vision", 2200, false, true), dataCell("Tesseract OCR, Google Vision API", 3200), dataCell("Screenshot analysis, document text extraction", 3960)] }),
        new TableRow({ children: [dataCell("Speech Processing", 2200, true, true), dataCell("Google Speech-to-Text / Azure Cognitive", 3200, true), dataCell("Voice input/output in Swahili and English", 3960, true)] }),
        new TableRow({ children: [dataCell("Translation", 2200, false, true), dataCell("Google Translate API / DeepL", 3200), dataCell("Real-time Swahili ↔ English translation", 3960)] }),
        new TableRow({ children: [dataCell("Database", 2200, true, true), dataCell("PostgreSQL + Redis (caching)", 3200, true), dataCell("Secure taxpayer data storage and session management", 3960, true)] }),
        new TableRow({ children: [dataCell("Cloud Hosting", 2200, false, true), dataCell("AWS / Azure Government Cloud", 3200), dataCell("Scalable, secure, compliant cloud infrastructure", 3960)] }),
        new TableRow({ children: [dataCell("Security", 2200, true, true), dataCell("TLS 1.3, AES-256 encryption, OAuth 2.0", 3200, true), dataCell("Data protection and secure taxpayer authentication", 3960, true)] }),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: RESOURCES ───────────────────────────────────────────────────────
function buildResources() {
  return [
    heading1("7. RESOURCE REQUIREMENTS"),
    heading2("7.1 Financial Resources"),
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [4680, 2340, 2340],
      rows: [
        new TableRow({ children: [headerCell("Budget Item", 4680), headerCell("Estimated Cost (TZS)", 2340), headerCell("Phase", 2340)] }),
        new TableRow({ children: [dataCell("AI API Subscriptions (OpenAI / Google)", 4680), dataCell("8,000,000 – 12,000,000", 2340, false, false, AlignmentType.RIGHT), dataCell("All Phases", 2340, false, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Cloud Hosting & Infrastructure (12 months)", 4680, true), dataCell("10,000,000 – 15,000,000", 2340, true, false, AlignmentType.RIGHT), dataCell("All Phases", 2340, true, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Software Development (contracted team)", 4680), dataCell("20,000,000 – 28,000,000", 2340, false, false, AlignmentType.RIGHT), dataCell("Phase 1–2", 2340, false, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Cybersecurity Audit & Penetration Testing", 4680, true), dataCell("4,000,000 – 6,000,000", 2340, true, false, AlignmentType.RIGHT), dataCell("Phase 2–3", 2340, true, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Staff Training & Change Management", 4680), dataCell("3,000,000 – 5,000,000", 2340, false, false, AlignmentType.RIGHT), dataCell("Phase 2–3", 2340, false, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Taxpayer Awareness Campaign", 4680, true), dataCell("2,500,000 – 4,000,000", 2340, true, false, AlignmentType.RIGHT), dataCell("Phase 3", 2340, true, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [dataCell("Contingency (10%)", 4680), dataCell("2,500,000 – 5,000,000", 2340, false, false, AlignmentType.RIGHT), dataCell("All Phases", 2340, false, false, AlignmentType.CENTER)] }),
        new TableRow({ children: [
          new TableCell({ borders: thinBorders, width: { size: 4680, type: WidthType.DXA }, shading: { fill: C.primary, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 }, children: [new Paragraph({ children: [new TextRun({ text: "TOTAL ESTIMATED BUDGET", font: "Arial", size: 22, bold: true, color: C.white })] })] }),
          new TableCell({ borders: thinBorders, width: { size: 2340, type: WidthType.DXA }, shading: { fill: C.primary, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 }, children: [new Paragraph({ alignment: AlignmentType.RIGHT, children: [new TextRun({ text: "50,000,000 – 75,000,000", font: "Arial", size: 22, bold: true, color: C.accent })] })] }),
          new TableCell({ borders: thinBorders, width: { size: 2340, type: WidthType.DXA }, shading: { fill: C.primary, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 }, children: [new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "8 Months", font: "Arial", size: 22, bold: true, color: C.white })] })] }),
        ]}),
      ]
    }),
    spacer(6),

    heading2("7.2 Human Resources"),
    body("Implementation requires a multidisciplinary team across three functional areas:"),
    spacer(4),
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [3120, 3120, 3120],
      rows: [
        new TableRow({ children: [headerCell("Technical Team", 3120), headerCell("TRA Internal Team", 3120), headerCell("Support & Management", 3120)] }),
        new TableRow({ children: [
          new TableCell({
            borders: thinBorders, width: { size: 3120, type: WidthType.DXA }, shading: { fill: C.white, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "Software Developers (2)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "AI/ML Engineers (2)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "UI/UX Designers (1)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "Cybersecurity Specialist (1)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "Database Administrator (1)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets4", level: 0 }, children: [new TextRun({ text: "QA & Testing Engineers (2)", font: "Arial", size: 20 })] }),
            ]
          }),
          new TableCell({
            borders: thinBorders, width: { size: 3120, type: WidthType.DXA }, shading: { fill: C.pale, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets5", level: 0 }, children: [new TextRun({ text: "Tax Experts / Domain SMEs (3)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets5", level: 0 }, children: [new TextRun({ text: "ICT Infrastructure Team", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets5", level: 0 }, children: [new TextRun({ text: "Customer Support Coordinators", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets5", level: 0 }, children: [new TextRun({ text: "Legal & Compliance Officers", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets5", level: 0 }, children: [new TextRun({ text: "Communications & PR Team", font: "Arial", size: 20 })] }),
            ]
          }),
          new TableCell({
            borders: thinBorders, width: { size: 3120, type: WidthType.DXA }, shading: { fill: C.white, type: ShadingType.CLEAR }, margins: { top: 100, bottom: 100, left: 130, right: 130 },
            children: [
              new Paragraph({ numbering: { reference: "bullets6", level: 0 }, children: [new TextRun({ text: "Project Manager (1)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets6", level: 0 }, children: [new TextRun({ text: "System Analysts (2)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets6", level: 0 }, children: [new TextRun({ text: "Training Coordinators (2)", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets6", level: 0 }, children: [new TextRun({ text: "Change Management Lead", font: "Arial", size: 20 })] }),
              new Paragraph({ numbering: { reference: "bullets6", level: 0 }, children: [new TextRun({ text: "Monitoring & Evaluation Officer", font: "Arial", size: 20 })] }),
            ]
          }),
        ]])
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: RISKS ───────────────────────────────────────────────────────────
function buildRisks() {
  return [
    heading1("8. RISK MANAGEMENT"),
    body("A comprehensive risk assessment has been conducted. The following table outlines each identified risk, its potential impact, likelihood, and the corresponding mitigation strategy."),
    spacer(6),

    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [2800, 1200, 1200, 4160],
      rows: [
        new TableRow({ children: [headerCell("Risk", 2800), headerCell("Likelihood", 1200), headerCell("Impact", 1200), headerCell("Mitigation Strategy", 4160)] }),
        new TableRow({ children: [dataCell("Data Privacy & Cybersecurity Threats", 2800, false, true), dataCell("Medium", 1200, false, false, AlignmentType.CENTER), dataCell("High", 1200, false, false, AlignmentType.CENTER), dataCell("Implement AES-256 encryption, TLS 1.3, regular security audits, and strict compliance with Tanzania's Data Protection Act", 4160)] }),
        new TableRow({ children: [dataCell("AI Incorrect or Misleading Responses", 2800, true, true), dataCell("Medium", 1200, true, false, AlignmentType.CENTER), dataCell("High", 1200, true, false, AlignmentType.CENTER), dataCell("Continuous model fine-tuning by TRA tax experts; human escalation fallback for complex or ambiguous queries", 4160, true)] }),
        new TableRow({ children: [dataCell("Resistance to Technology Adoption", 2800, false, true), dataCell("High", 1200, false, false, AlignmentType.CENTER), dataCell("Medium", 1200, false, false, AlignmentType.CENTER), dataCell("Comprehensive awareness campaigns, simplified UI, phased rollout, and dedicated onboarding support for both staff and taxpayers", 4160)] }),
        new TableRow({ children: [dataCell("Limited Internet Access in Rural Areas", 2800, true, true), dataCell("High", 1200, true, false, AlignmentType.CENTER), dataCell("Medium", 1200, true, false, AlignmentType.CENTER), dataCell("Lightweight mobile app optimized for 2G/3G; offline mode for key educational content; USSD fallback option", 4160, true)] }),
        new TableRow({ children: [dataCell("TRA Systems Integration Complexity", 2800, false, true), dataCell("Medium", 1200, false, false, AlignmentType.CENTER), dataCell("High", 1200, false, false, AlignmentType.CENTER), dataCell("Dedicated integration team; sandbox testing environment; phased integration starting with read-only access in Phase 1", 4160)] }),
        new TableRow({ children: [dataCell("High Development & Maintenance Costs", 2800, true, true), dataCell("Low", 1200, true, false, AlignmentType.CENTER), dataCell("Medium", 1200, true, false, AlignmentType.CENTER), dataCell("Open-source technology preference; phased budget releases tied to milestone delivery; cost-benefit review at each phase", 4160, true)] }),
        new TableRow({ children: [dataCell("Low Digital Literacy Among Taxpayers", 2800, false, true), dataCell("High", 1200, false, false, AlignmentType.CENTER), dataCell("Medium", 1200, false, false, AlignmentType.CENTER), dataCell("Voice assistant removes typing requirement; simplified UI with large icons and visual guides; Swahili-first design philosophy", 4160)] }),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: SUCCESS METRICS ─────────────────────────────────────────────────
function buildSuccessMetrics() {
  return [
    heading1("9. SUCCESS METRICS & KEY PERFORMANCE INDICATORS"),
    body("The following KPIs will be tracked quarterly to measure the platform's performance and return on investment:"),
    spacer(6),

    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [3600, 2200, 3560],
      rows: [
        new TableRow({ children: [headerCell("KPI", 3600), headerCell("Target (Year 1)", 2200), headerCell("Measurement Method", 3560)] }),
        new TableRow({ children: [dataCell("Monthly Active Users on AI Platform", 3600), dataCell("50,000+", 2200, false, true, AlignmentType.CENTER), dataCell("Platform analytics dashboard", 3560)] }),
        new TableRow({ children: [dataCell("Customer Support Call Volume Reduction", 3600, true), dataCell("40% reduction", 2200, true, true, AlignmentType.CENTER), dataCell("TRA call center records comparison", 3560, true)] }),
        new TableRow({ children: [dataCell("TIN Registration Completion Rate", 3600), dataCell("85%+ completion", 2200, false, true, AlignmentType.CENTER), dataCell("ITAX system data vs. abandonment logs", 3560)] }),
        new TableRow({ children: [dataCell("Taxpayer Satisfaction Score (CSAT)", 3600, true), dataCell("4.2/5.0+", 2200, true, true, AlignmentType.CENTER), dataCell("In-platform satisfaction surveys", 3560, true)] }),
        new TableRow({ children: [dataCell("AI Response Accuracy Rate", 3600), dataCell("92%+ accurate", 2200, false, true, AlignmentType.CENTER), dataCell("Monthly expert review of AI responses", 3560)] }),
        new TableRow({ children: [dataCell("Screenshot Analysis Success Rate", 3600, true), dataCell("88%+ resolved", 2200, true, true, AlignmentType.CENTER), dataCell("User confirmation post-interaction", 3560, true)] }),
        new TableRow({ children: [dataCell("Swahili Interaction Volume", 3600), dataCell("60%+ of sessions", 2200, false, true, AlignmentType.CENTER), dataCell("Language detection logs", 3560)] }),
        new TableRow({ children: [dataCell("Document Rejection Rate Reduction", 3600, true), dataCell("50% reduction", 2200, true, true, AlignmentType.CENTER), dataCell("Document processing records", 3560, true)] }),
      ]
    }),
    spacer(8),
    new Paragraph({ children: [new PageBreak()] })
  ];
}

// ─── SECTION: CONCLUSION ──────────────────────────────────────────────────────
function buildConclusion() {
  return [
    heading1("10. CONCLUSION & RECOMMENDATION"),
    body("TRA SmartAssist AI represents a transformational leap in how Tanzania's Revenue Authority serves its taxpayers. By combining the power of artificial intelligence, multilingual support, visual assistance, and voice interaction, this platform directly addresses the most pressing challenges faced by taxpayers daily — confusion, language barriers, document errors, and inaccessible support."),
    spacer(4),
    body("This is not merely a chatbot upgrade. It is a comprehensive Intelligent Taxpayer Assistance Ecosystem that will make TRA services more accessible, more efficient, and more trusted — especially for the millions of Tanzanians in the informal economy who represent the greatest untapped potential for tax base expansion."),
    spacer(4),
    body("The phased 8-month implementation plan, backed by a well-defined budget of TZS 50–75 million, provides a responsible and measurable path to deployment. With strong ICT infrastructure, cross-departmental collaboration, and a commitment to continuous improvement, TRA SmartAssist AI is positioned to become a flagship example of digital government innovation in East Africa."),
    spacer(6),

    // Final recommendation box
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [9360],
      rows: [
        new TableRow({ children: [
          new TableCell({
            borders: { top: { style: BorderStyle.SINGLE, size: 10, color: C.accent }, bottom: { style: BorderStyle.SINGLE, size: 10, color: C.accent }, left: { style: BorderStyle.SINGLE, size: 10, color: C.accent }, right: { style: BorderStyle.SINGLE, size: 10, color: C.accent } },
            width: { size: 9360, type: WidthType.DXA },
            shading: { fill: "EBF5FB", type: ShadingType.CLEAR },
            margins: { top: 200, bottom: 200, left: 300, right: 300 },
            children: [
              new Paragraph({ alignment: AlignmentType.CENTER, children: [new TextRun({ text: "RECOMMENDATION", font: "Arial", size: 26, bold: true, color: C.primary })] }),
              spacer(4),
              new Paragraph({ alignment: AlignmentType.JUSTIFIED, children: [new TextRun({ text: "It is hereby recommended that TRA Management approves the TRA SmartAssist AI project for inclusion in the ICT Innovation Portfolio and allocates the necessary budgetary, technological, and human resources to commence Phase 1 development immediately. This innovation has the potential to improve service delivery, expand Tanzania's tax base, and position TRA as a leader in AI-powered public service delivery across the African continent.", font: "Arial", size: 22, color: C.dark })] }),
            ]
          })
        ]])
      ]
    }),
    spacer(12),

    // Sign-off
    new Table({
      width: { size: 9360, type: WidthType.DXA },
      columnWidths: [4680, 4680],
      rows: [
        new TableRow({ children: [
          new TableCell({
            borders: noBorders,
            width: { size: 4680, type: WidthType.DXA },
            shading: { fill: C.white, type: ShadingType.CLEAR },
            margins: { top: 200, bottom: 80, left: 0, right: 80 },
            children: [
              new Paragraph({ border: { bottom: { style: BorderStyle.SINGLE, size: 4, color: C.secondary, space: 4 } }, children: [new TextRun({ text: "", font: "Arial", size: 22 })] }),
              spacer(4),
              new Paragraph({ children: [new TextRun({ text: "Prepared by", font: "Arial", size: 20, color: C.gray })] }),
              new Paragraph({ children: [new TextRun({ text: "ICT & Innovation Division, TRA", font: "Arial", size: 22, bold: true, color: C.primary })] }),
            ]
          }),
          new TableCell({
            borders: noBorders,
            width: { size: 4680, type: WidthType.DXA },
            shading: { fill: C.white, type: ShadingType.CLEAR },
            margins: { top: 200, bottom: 80, left: 80, right: 0 },
            children: [
              new Paragraph({ border: { bottom: { style: BorderStyle.SINGLE, size: 4, color: C.secondary, space: 4 } }, children: [new TextRun({ text: "", font: "Arial", size: 22 })] }),
              spacer(4),
              new Paragraph({ children: [new TextRun({ text: "Date", font: "Arial", size: 20, color: C.gray })] }),
              new Paragraph({ children: [new TextRun({ text: "May 2026", font: "Arial", size: 22, bold: true, color: C.primary })] }),
            ]
          }),
        ]])
      ]
    }),
  ];
}

// ─── MAIN DOCUMENT ────────────────────────────────────────────────────────────
async function main() {
  const doc = new Document({
    numbering: {
      config: [
        { reference: "bullets",  levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "bullets2", levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "bullets3", levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "bullets4", levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "bullets5", levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "bullets6", levels: [{ level: 0, format: LevelFormat.BULLET, text: "\u2022", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
        { reference: "numbers",  levels: [{ level: 0, format: LevelFormat.DECIMAL, text: "%1.", alignment: AlignmentType.LEFT, style: { paragraph: { indent: { left: 560, hanging: 280 } } } }] },
      ]
    },
    styles: {
      default: { document: { run: { font: "Arial", size: 22 } } },
      paragraphStyles: [
        { id: "Heading1", name: "Heading 1", basedOn: "Normal", next: "Normal", quickFormat: true,
          run: { size: 36, bold: true, font: "Arial", color: C.primary },
          paragraph: { spacing: { before: 360, after: 160 }, outlineLevel: 0 } },
        { id: "Heading2", name: "Heading 2", basedOn: "Normal", next: "Normal", quickFormat: true,
          run: { size: 28, bold: true, font: "Arial", color: C.secondary },
          paragraph: { spacing: { before: 280, after: 120 }, outlineLevel: 1 } },
      ]
    },
    sections: [{
      properties: {
        page: {
          size: { width: 12240, height: 15840 },
          margin: { top: 1080, right: 1080, bottom: 1080, left: 1080 }
        }
      },
      headers: {
        default: new Header({
          children: [
            new Paragraph({
              border: { bottom: { style: BorderStyle.SINGLE, size: 4, color: C.secondary, space: 4 } },
              tabStops: [{ type: TabStopType.RIGHT, position: 9360 }],
              children: [
                new TextRun({ text: "TRA SmartAssist AI — Project Proposal", font: "Arial", size: 18, color: C.secondary, bold: true }),
                new TextRun({ text: "\t", font: "Arial", size: 18 }),
                new TextRun({ text: "CONFIDENTIAL | May 2026", font: "Arial", size: 18, color: C.gray }),
              ]
            })
          ]
        })
      },
      footers: {
        default: new Footer({
          children: [
            new Paragraph({
              border: { top: { style: BorderStyle.SINGLE, size: 4, color: C.accent, space: 4 } },
              tabStops: [{ type: TabStopType.RIGHT, position: 9360 }],
              children: [
                new TextRun({ text: "Tanzania Revenue Authority  |  ICT & Innovation Division", font: "Arial", size: 18, color: C.gray }),
                new TextRun({ text: "\t", font: "Arial", size: 18 }),
                new TextRun({ text: "Page ", font: "Arial", size: 18, color: C.gray }),
                new PageNumber(),
              ]
            })
          ]
        })
      },
      children: [
        ...buildCoverPage(),
        ...buildExecutiveSummary(),
        ...buildInnovationDescription(),
        ...buildExistingPractices(),
        ...buildImpactAreas(),
        ...buildSystemModules(),
        ...buildImplementationPlan(),
        ...buildTechStack(),
        ...buildResources(),
        ...buildRisks(),
        ...buildSuccessMetrics(),
        ...buildConclusion(),
      ]
    }]
  });

  const buffer = await Packer.toBuffer(doc);
  fs.writeFileSync("/mnt/user-data/outputs/TRA_SmartAssist_AI_Proposal.docx", buffer);
  console.log("✅ Proposal generated successfully!");
}

main().catch(console.error);